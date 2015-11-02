<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\DeliveryState;
use Illuminate\Http\Request;
use Datatables;
use DB;

class DeliveryController extends Controller {

    const NAMEC = 'delivery';

    public function __construct() {
        $this->middleware('authadmin');
    }

    public function getIndex() {
        return viewc('admin.' . self::NAMEC . '.index');
    }

    public function getForm($id = null) {
        $typeDeliveryState = DeliveryState::where('flagactive', '=', '1')->lists('nameapp', 'id');
        $typeDeliveryState = [null => 'Please select one option'] + $typeDeliveryState;
        $table = new Delivery();
        if (!empty($id)) {
            $table = Delivery::find($id);
        }
        return viewc('admin.' . self::NAMEC . '.form', compact('table'), ['typeDeliveryState' => $typeDeliveryState]);
    }

    public function postForm(Request $request) {
        if (!empty($request)) {
            $data = $request->all();
            $data['flagactive'] = $request->get('flagactive', 1);
            if ($request->id) {
                $obj = Delivery::find($request->id);
                $obj->update($data);
            } else {
                $obj = Region::create($data);
            }
            return redirect('admpanel/' . self::NAMEC)->with('messageSuccess', 'Estado Delivery Guardado');
        }
        return redirect('admpanel')->with('messageError', 'Error al guardar el Delivery');
    }

    public function getList(Request $request) {

        $datestart = $request->input('datastart');
        $dateend = $request->input('dataend');
        if (isset($datestart)) {
            $ini = explode("/", $datestart);
            $DateIni = $ini[2] . '-' . $ini[1] . '-' . $ini[0] . ' 00:00:00';
        } else {
            $DateIni = null;
        }
        if (isset($dateend)) {
            $fin = explode("/", $dateend);
            $DateFinish = $fin[2] . '-' . $fin[1] . '-' . $fin[0] . ' 23:59:59';
        } else {
            $DateFinish = null;
        }
        $table = DB::table('deliveries')
                ->join('vehicletypes', 'deliveries.vehicletype_id', '=', 'vehicletypes.id')
                ->join('paymenttypes', 'deliveries.paymenttype_id', '=', 'paymenttypes.id')
                ->join('customers', 'deliveries.customer_id', '=', 'customers.id')
                ->join('drivers', 'deliveries.driver_id', '=', 'drivers.id')
                ->join('categories', 'deliveries.category_id', '=', 'categories.id')
                ->join('delivery_state', 'deliveries.delivery_state_id', '=', 'delivery_state.id')
                ->join('delivery_type', 'deliveries.delivery_type_id', '=', 'delivery_type.id')
                ->select('deliveries.id', 'deliveries.datestart', 'deliveries.number_points'
                        , 'deliveries.price', 'deliveries.code', 'vehicletypes.name as vehicletype', 'drivers.lastname',
//                        DB::raw("CONCAT(drivers.namedriver, ' ', drivers.lastname) As nameDriver") ,
                        'paymenttypes.name as paymenttype', 'categories.name as category', 'customers.name_customer as nameCustomer', 'delivery_type.name as delivery_type'
                        , 'delivery_state.nameapp as delivery_state')
                ->where('deliveries.flagactive', '=', 1);
        if ($datestart != null) {
            $table = $table->whereBetween('deliveries.datestart', [$datestart, $DateFinish]);
        }
        $table = $table->orderBy('deliveries.datestart', 'desc');
        $total =  $this->sumaTotal($datestart,$DateFinish);
        $datatable = Datatables::of($table)
                ->editColumn('datestart', '{{ date("d/m/Y H:i:s", strtotime($datestart)) }}')
                ->addColumn('action', function($table) {
            return '<a href="/admpanel/' . self::NAMEC . '/form/' . $table->id . '" class="btn btn-warning">Editar</a>
                            <a href="#" data-url="/admpanel/' . self::NAMEC . '/delete/' . $table->id . '" class="btn btn-danger action_delete"  data-id="' . $table->id . '" >Eliminar</a>';
        });

        if ($keyword = $request->get('search')['value']) {

            $datatable->filterColumn('precio', 'whereRaw', "deliveries.price like ?", ["%{$keyword}%"]);
            $datatable->filterColumn('vehicletype', 'whereRaw', "vehicletypes.name like ?", ["%{$keyword}%"]);
            $datatable->filterColumn('paymenttype', 'whereRaw', "paymenttypes.name like ?", ["%{$keyword}%"]);
            $datatable->filterColumn('category', 'whereRaw', "categories.name  like ?", ["%{$keyword}%"]);
            $datatable->filterColumn('delivery_type', 'whereRaw', "delivery_type.name like ?", ["%{$keyword}%"]);
            $datatable->filterColumn('delivery_state', 'whereRaw', "delivery_state.nameapp like ?", ["%{$keyword}%"]);
            $datatable->filterColumn('nameCustomer', 'whereRaw', "customers.name_customer like ?", ["%{$keyword}%"]);
        }
        $datatable->addRowAttr('deliverytotal',$total);
        return $datatable->make(true);
    }
    
    public function sumaTotal($datestart,$DateFinish) {
         $table = DB::table('deliveries')
                ->join('vehicletypes', 'deliveries.vehicletype_id', '=', 'vehicletypes.id')
                ->join('paymenttypes', 'deliveries.paymenttype_id', '=', 'paymenttypes.id')
                ->join('customers', 'deliveries.customer_id', '=', 'customers.id')
                ->join('drivers', 'deliveries.driver_id', '=', 'drivers.id')
                ->join('categories', 'deliveries.category_id', '=', 'categories.id')
                ->join('delivery_state', 'deliveries.delivery_state_id', '=', 'delivery_state.id')
                ->join('delivery_type', 'deliveries.delivery_type_id', '=', 'delivery_type.id')
                ->select(DB::raw(' SUM(deliveries.price) as total'))
                ->where('deliveries.flagactive', '=', 1);
        if ($datestart != null) {
            $table = $table->whereBetween('deliveries.datestart', [$datestart, $DateFinish]);
        }
        $table = $table->orderBy('deliveries.datestart', 'desc')->get();
        
        return round($table[0]->total,2);
    }

    public function getDelete($id) {
        $table = null;
        if (!empty($id)) {
            $table = Delivery::find($id);
            $table->delete();
        }
        return response()->json('true');
    }

}

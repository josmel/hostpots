<?php
/**
 * Created by PhpStorm.
 * User: netmaster
 * Date: 9/17/15
 * Time: 5:39 PM
 */

namespace App\Http\Controllers\Wservice;

use App\Http\Controllers\ControllerWS;

use App\Models\Contact;
use App\Models\Customer;
use App\Models\Delivery;
use App\Models\DeliveryType;
use App\Models\DeliveryState;

use App\Models\Route;
use DB;

use Illuminate\Http\Response;

class ServiceController extends ControllerWS
{
      const INMEDIATO = 'Inmediato';
      const PROGRAMADO = 'Programado';
    public function deliveryPrice($lat_1,$lon_1,$lat_2,$lon_2,$zone,$calculate)
    {
        try {
            $price = DB::select(DB::raw('select geo_price(GeomFromText( \'POINT('.$lat_1.' '.$lon_1.')\'),GeomFromText( \'POINT('.$lat_2.' '.$lon_2.')\'),\''.$zone.'\','.$calculate.') as price'));
            $this->_responseWS->setDataResponse(
                Response::HTTP_OK,
                isset($price[0])?(array)$price[0]:null,
                array(),
                'ok'
            );
        } catch (\Exception $exc) {
            $this->_responseWS->setDataResponse(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                array(),
                array(),
                $exc->getMessage()
            );
        }
$this->_responseWS->response();
    }
    
    public function listServices($year,$month,$day,$status_id = 0,$complet = 0,$customer_id = 0)
    {
        try {
            $results = array();
            $whereIn = $complet?'whereIn':'whereNotIn';
            $filters = Delivery::$whereIn('delivery_state_id',array(
                DeliveryState::FINISHED,DeliveryState::RETURNED,DeliveryState::CANCELED)
            );     
            if(!empty($status_id)){
                $filters = Delivery::where('delivery_state_id','=',$status_id);
            }
            if(!empty($customer_id)){
                $filters = $filters->whereCustomerId($customer_id);
            }
            $filters = $filters->get();
            foreach ($filters as $filter)
            {
                if($year!="0000")
                {
                    $year_item=\DateTime::createFromFormat('Y-m-d H:i:s',$filter->datestart)->format('Y');
                    if($year!=$year_item)
                    {
                        continue;
                    }
                }
                if($month!="00")
                {
                    $month_item=\DateTime::createFromFormat('Y-m-d H:i:s',$filter->datestart)->format('m');
                    if($month!=$month_item)
                    {
                        continue;
                    }
                }
                if($day!="00")
                {
                    $day_item=\DateTime::createFromFormat('Y-m-d H:i:s',$filter->datestart)->format('d');
                    if($day!=$day_item)
                    {
                        continue;
                    }
                }

                $dt = DeliveryType::find($filter->delivery_type_id);
                $ds = DeliveryState::find($filter->delivery_state_id);
                $contact = Contact::where('customer_id','=',$filter->customer_id)->get()->first();

                $matchThese = ['delivery_id' => $filter->id, 'flag_destino' => 1];
                $route_destino = Route::where($matchThese)->get()->first();
                //$route_destino = array_values($route_destino_a)[0];
if($filter->flagservice==1){
    $dt->name =  self::INMEDIATO.' '.$dt->name;
}else{
     $dt->name =  self::PROGRAMADO.' '.$dt->name;
}
                
                $tmpService = array(
                    'id'=>$filter->id,
                    'delivery_type_id'=>$filter->delivery_type_id,
                    'delivery_type_name'=>$dt->name,
                    'delivery_state_id'=>$filter->delivery_state_id,
                    'delivery_state_name'=>$ds->nameapp,
                    'datestart'=>$filter->datestart,
                    'destination_description'=>$route_destino->description,
                    'destination_address'=>$route_destino->address,
                    'publish_date'=>\DateTime::createFromFormat('Y-m-d H:i:s',$filter->datestart)->format('d-m-Y'),
                    'publish_time'=>\DateTime::createFromFormat('Y-m-d H:i:s',$filter->datestart)->format('H:i:s'),
                    'price'=>\round($filter->price,2),
                    'contact_name'=>$contact->name,
                    'contact_phone'=>$contact->phone
                );

                $results[]=$tmpService;
            }
//            $promotions = $region->promotionRegion();
            $this->_responseWS->setDataResponse(
                Response::HTTP_OK,
                $results,array(),
                'ok'
            );
        } catch (\Exception $exc) {
            $this->_responseWS->setDataResponse(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                array(),
                array(),
                $exc->getMessage()
            );
        }
        $this->_responseWS->response();
    }
}

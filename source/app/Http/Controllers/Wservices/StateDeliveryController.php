<?php namespace App\Http\Controllers\Wservice;

use App\Http\Controllers\ControllerWS;
use App\Http\Requests\Wservices\StateDeliveryRequest;
//use App\Http\Statemachine;
use App\Models\Delivery;
use App\Models\Driver;
use App\Models\Route;
use DB;
use Illuminate\Http\Response;
use App\Models\DeliveryState;

class StateDeliveryController extends ControllerWS
{
    public function transitionStateDelivery(StateDeliveryRequest $request)
    {        

        try {
            $idDelivery=$request->input('id');
            $idState = $request->input('event');
            $idDriver = $request->input('driver');
            $delivery =  Delivery::find($idDelivery);
            if(!$delivery){throw new \Exception('No existe delivery');}
            $dataDelivery=$delivery->toArray();           
            $dataUpdate['delivery_state_id'] = $idState;
            if($dataDelivery['driver_id']==null){$dataUpdate['driver_id']=$idDriver;}
            if($idState==7 || $idState==9 || $idState ==8){
                $driver = Driver::find($idDriver);
                $dataUpdateDriver=array('driver_state_id'=>1);
                $driver->update($dataUpdateDriver);
            }
            if($idState==7 ){
                $driver = Driver::find($idDriver);
                $dataUpdateDriver=array('driver_state_id'=>1);
                $driver->update($dataUpdateDriver);
            }
            
//            $objState = new Statemachine\OSPDelivery(new Statemachine\RequestedDeliveryState());
//            $dataRpta = $objState->giveback();
            
            $delivery->update($dataUpdate);
            $dataRpta=array('oldState'=>$dataDelivery['delivery_state_id']
                ,'currentState'=>$dataUpdate['delivery_state_id']);
//            if(!empty($delivery['id'])){         
                    
            $this->_responseWS->setDataResponse(Response::HTTP_OK, $dataRpta, 
                            array(), '');                                   
        } catch (\Exception $exc) {
            $this->_responseWS->setDataResponse(
                Response::HTTP_INTERNAL_SERVER_ERROR, array(), array(),
                $exc->getMessage());
        }
        $this->_responseWS->response();
    }
    
    public function getList()
    {
        try {
            $deliverySTate = DeliveryState::all();
            $this->_responseWS->setDataResponse(Response::HTTP_OK, $deliverySTate->toArray(), array(), '');
        } catch (\Exception $exc) {
            $this->_responseWS->setDataResponse(
                Response::HTTP_INTERNAL_SERVER_ERROR, array(), array(),
                $exc->getMessage());
        }
        $this->_responseWS->response();
    }
    
    public function getListDeliveryDriver($idDriver)
    {
        try {
            $deliveries = Delivery::where('driver_id',$idDriver)->whereFlagactive(1)
                ->select('id','code','customer_id','delivery_state_id','datestart','datepublish','delivery_type_id',
                'dateseparate','price','flagservice','flagreturn','flagactive','lastupdate')
                ->orderBy('id','desc')->get();    

            if(empty($deliveries)){throw new \Exception('No tienes entregas realizadas'); }
            $dataDelivery = $deliveries->toArray();
            foreach($dataDelivery AS $index=>$value){                
                $routes = Route::where('delivery_id',$value['id'])
                ->select('id',DB::raw('x(coordenate)'),DB::raw('y(coordenate)'),'order_route',
                    'address','description','contact_name','contact_phone','contact_cellphone',
                    'contact_email','flagactive')->get();
                $dataRoute=$routes->toArray();
                $dataDelivery[$index]['dataRoute']=$dataRoute;
            }
                        
            $this->_responseWS->setDataResponse(Response::HTTP_OK, $dataDelivery, array(), '');
        } catch (\Exception $exc) {
            $this->_responseWS->setDataResponse(
                Response::HTTP_INTERNAL_SERVER_ERROR, array(), array(),
                $exc->getMessage());
        }
        $this->_responseWS->response();
    }
    
    public function getDetail($idDelivery)
    {
        try {          
            $delivery = Delivery::find($idDelivery);            
            if(!$delivery){ throw new \Exception('Delivery inexistente');}
            $dataDelivery=$delivery->toArray();
            $routes = Route::where('delivery_id',$idDelivery)
                ->select('id',DB::raw('x(coordenate)'),DB::raw('y(coordenate)'),'order_route',
                    'address','description','contact_name','contact_phone','contact_cellphone',
                    'contact_email','flagactive')->get();
            $dataRoute=$routes->toArray();                
            $dataDelivery['dataRoute']=$dataRoute;
            $this->_responseWS->setDataResponse(Response::HTTP_OK,$dataDelivery, array(), '');
        } catch (\Exception $exc) {
            $this->_responseWS->setDataResponse(
                Response::HTTP_INTERNAL_SERVER_ERROR, array(), array(),
                $exc->getMessage());
        }
        $this->_responseWS->response();
    }
    
    public function getTesting()
    {
        try {          
            $data=array('images_thumbnail'=>array('http://cdn.globalenergyrace.com/sites/default/files/twitter-ge_1.png',
                'http://static-5.app4smart.me/i/icon/40/crx/qo5/ovw/tersus-20-icon-pack.png',
                'http://cdn.globalenergyrace.com/sites/default/files/instagram-ge_1.png'),
                'images_origin'=>array('http://images.huffingtonpost.com/2015-07-27-1438004348-2061889-56941434_thumbnail.jpg',
                'https://www.mobilecommons.com/wp/wp-content/uploads/2014/08/45823474_thumbnail.jpg',
                'http://bookkeepers.directory/wp-content/uploads/2015/06/39400350_thumbnail.jpg'));
            $this->_responseWS->setDataResponse(Response::HTTP_OK,$data, array(), '');
        } catch (\Exception $exc) {
            $this->_responseWS->setDataResponse(
                Response::HTTP_INTERNAL_SERVER_ERROR, array(), array(),
                $exc->getMessage());
        }
        $this->_responseWS->response();
    }
}

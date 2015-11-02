<?php namespace App\Http\Controllers\Wservice;

use App\Http\Controllers\ControllerWS;
use App\Http\Requests\Wservices\StateDriverRequest;
use App\Models\Driver;
use App\Models\Delivery;
use Illuminate\Http\Response;

class StateDriverController extends ControllerWS
{
    public function changeStateDriver(StateDriverRequest $request)
    {        

        try {
            $idDriver=$request->input('id');
            $idState = $request->input('state');
            $driver =  Driver::find($idDriver);
            if(!$driver){throw new \Exception('Chofer inexistente');}
            $dataDriver=$driver->toArray();
            if($dataDriver['id']!=$idDriver){ throw new Exception('Chofer no puede cambiar estado de otro');}
            $dataUpdate['driver_state_id'] = $idState;            
            $driver->update($dataUpdate);
            $dataRpta=array('oldState'=>$dataDriver['driver_state_id']
                ,'currentState'=>$dataUpdate['driver_state_id']);                          
            $this->_responseWS->setDataResponse(Response::HTTP_OK, $dataRpta,array(), '');                                   
        } catch (\Exception $exc) {
            $this->_responseWS->setDataResponse(
                Response::HTTP_INTERNAL_SERVER_ERROR, array(), array(),
                $exc->getMessage());
        }
        $this->_responseWS->response();
    }
    

    public function getDetail($idDriver)
    {
        try {                     
            $driver = Driver::find($idDriver);            
            if(!$driver){ throw new \Exception('Chofer inexistente');}
            $dataDriver=$driver->toArray();
            $dataDriver['delivery']=$this->getDeliveryByDriver($idDriver);
            $this->_responseWS->setDataResponse(Response::HTTP_OK,$dataDriver, array(), '');
        } catch (\Exception $exc) {
            $this->_responseWS->setDataResponse(
                Response::HTTP_INTERNAL_SERVER_ERROR, array(), array(),
                $exc->getMessage());
        }
        
        $this->_responseWS->response();
    }
    /**
     * 
     * @param type $idDriver
     * @return 
     */
    public function getDeliveryByDriver($idDriver)
    {           
        $delivery = Delivery::whereDriverId($idDriver)->whereFlagactive(1)
            ->whereNotIn('delivery_state_id',array(9,8,1,7))
            ->select('id','code','customer_id','delivery_type_id','delivery_state_id','datestart','datepublish',
                'dateseparate','price','flagservice','flagreturn','flagactive','lastupdate')
            ->orderBy('id','desc')->get();
            
        $dataDelivery = $delivery->toArray();
        if($dataDelivery){ 
            return $dataDelivery;        
        }else{
            return null;
        }
    }
}

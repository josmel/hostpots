<?php namespace App\Http\Statemachine;

use App\Models\Delivery;
use App\Http\Statemachine;

class FactoryState
{            
    public static function getStateDelivery($idState)
    {
        switch($idState){
            case 1 : $obj = new App\Http\Statemachine\WaitingDeliveryState();
                break;
            case 2 : $obj = new RequestedDeliveryState();
                break;
            case 3 : $obj = new ReservedDeliveryState();
                break;
            case 4 : $obj = new CollectingDeliveryState();
                break;
            case 5 : $obj = new InrouteDeliveryState();
                break;
            case 6 : $obj = new DeliveredDeliveryState();
                break;
            case 7 : $obj = new FinishedDeliveryState();
                break;
            case 8 : $obj = new ReturnedDeliveryState();
                break;
            case 9 : $obj = new CanceledDeliveryState();
                break;
            default : throw new Exception('Estado inexsistente');
        
        }    
        return $obj;
    }
}

<?php namespace App\Http\Statemachine;

use App\Models\Delivery;

class WaitingDeliveryState extends AbstractDeliveryState
{
    
   
    /**
     * @return RequestedDeliveryState
     */
    public function start()
    {
        
        
        return new RequestedDeliveryState;
    }

    /**
     * @return CanceledDeliveryState
     */
    public function cancel()
    {
        return new CanceledDeliveryState;
    }
        
    
}

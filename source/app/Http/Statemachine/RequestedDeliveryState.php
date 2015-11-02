<?php namespace App\Http\Statemachine;
class RequestedDeliveryState extends AbstractDeliveryState
{
    /**
     * @return ReservedDeliveryState
     */
    public function separate()
    {
        return new ReservedDeliveryState;
    }

    /**
     * @return CanceledDeliveryState
     */
    public function cancel()
    {
        return new CanceledDeliveryState;
    }
    
    public function sendNotification($idCustomer)
    {
        return true;
    }
}

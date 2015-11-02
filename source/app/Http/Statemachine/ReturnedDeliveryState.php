<?php namespace App\Http\Statemachine;
class ReturnedDeliveryState extends AbstractDeliveryState
{
    /**
     * @return WaitingDeliveryState
     */
    public function request()
    {
        return new WaitingDeliveryState;
    }
}

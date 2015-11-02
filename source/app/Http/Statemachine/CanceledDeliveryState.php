<?php namespace App\Http\Statemachine;

class CanceledDeliveryState extends AbstractDeliveryState
{
    /**
     * @return WaitingDeliveryState
     */
    public function request()
    {
        return new WaitingDeliveryState;
    }
}

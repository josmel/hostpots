<?php namespace App\Http\Statemachine;

class CollectingDeliveryState extends AbstractDeliveryState
{
    /**
     * @return InrouteDeliveryState
     */
    public function dispatch()
    {
        return new InrouteDeliveryState;
    }

    /**
     * @return CanceledDeliveryState
     */
    public function cancel()
    {
        return new CanceledDeliveryState;
    }
}

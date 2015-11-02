<?php namespace App\Http\Statemachine;
class InrouteDeliveryState extends AbstractDeliveryState
{
    /**
     * @return DeliveredDeliveryState
     */
    public function deliver()
    {
        return new DeliveredDeliveryState;
    }

    /**
     * @return ReturnedDeliveryState
     */
    public function giveback()
    {
        return new ReturnedDeliveryState;
    }

    /**
     * @return CanceledDeliveryState
     */
    public function cancel()
    {
        return new CanceledDeliveryState;
    }
}

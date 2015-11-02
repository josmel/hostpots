<?php namespace App\Http\Statemachine;
class ReservedDeliveryState extends AbstractDeliveryState
{
    /**
     * @return CollectingDeliveryState
     */
    public function collect()
    {
        return new CollectingDeliveryState;
    }

    /**
     * @return CanceledDeliveryState
     */
    public function cancel()
    {
        return new CanceledDeliveryState;
    }
}

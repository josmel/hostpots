<?php namespace App\Http\Statemachine;
class DeliveredDeliveryState extends AbstractDeliveryState
{
    /**
     * @return FinishedDeliveryState
     */
    public function release()
    {
        return new FinishedDeliveryState;
    }
}

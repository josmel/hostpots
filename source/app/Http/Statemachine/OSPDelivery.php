<?php namespace App\Http\Statemachine;
class OSPDelivery
{
    /**
     * @var DeliveryState
     */
    private $state;

    public function __construct(DeliveryState $state)
    {
        $this->setState($state);
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function start()
    {        
        echo "hosada saodh adso ad"; 
        $this->setState($this->state->start());
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function request()
    {
        $this->setState($this->state->request());
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function separate()
    {
        echo "Holaaa;";
        $this->setState($this->state->separate());
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function collect()
    {
        $this->setState($this->state->collect());
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function dispatch()
    {
        $this->setState($this->state->dispatch());
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function deliver()
    {
        $this->setState($this->state->deliver());
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function giveback()
    {
        $this->setState($this->state->giveback());
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function release()
    {
        $this->setState($this->state->release());
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function cancel()
    {
        $this->setState($this->state->cancel());
    }

    /**
     * @return bool
     */
    public function isWaiting()
    {
        return $this->state instanceof WaitingDeliveryState;
    }

    /**
     * @return bool
     */
    public function isRequested()
    {
        return $this->state instanceof RequestedDeliveryState;
    }

    /**
     * @return bool
     */
    public function isReserved()
    {
        return $this->state instanceof ReservedDeliveryState;
    }

    /**
     * @return bool
     */
    public function isCollecting()
    {
        return $this->state instanceof CollectingDeliveryState;
    }

    /**
     * @return bool
     */
    public function isInroute()
    {
        return $this->state instanceof InrouteDeliveryState;
    }

    /**
     * @return bool
     */
    public function isReturned()
    {
        return $this->state instanceof ReturnedDeliveryState;
    }

    /**
     * @return bool
     */
    public function isDelivered()
    {
        return $this->state instanceof DeliveredDeliveryState;
    }

    /**
     * @return bool
     */
    public function isFinished()
    {
        return $this->state instanceof FinishedDeliveryState;
    }

    /**
     * @return bool
     */
    public function isCanceled()
    {
        return $this->state instanceof CanceledDeliveryState;
    }

    private function setState(DeliveryState $state)
    {
        $this->state = $state;
    }
}

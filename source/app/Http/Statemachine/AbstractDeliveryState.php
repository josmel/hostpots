<?php namespace App\Http\Statemachine;



abstract  class AbstractDeliveryState implements DeliveryState
{
    /**
     * @throws IllegalStateTransitionException
     */
    public function start()
    {
        throw new IllegalStateTransitionException;
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function request()
    {
        throw new IllegalStateTransitionException;
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function separate()
    {
        throw new IllegalStateTransitionException;
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function collect()
    {
        throw new IllegalStateTransitionException;
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function dispatch()
    {
        throw new IllegalStateTransitionException;
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function deliver()
    {
        throw new IllegalStateTransitionException;
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function giveback()
    {
        throw new IllegalStateTransitionException('Metodo no permitido');
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function release()
    {
        throw new IllegalStateTransitionException('ohohohoho');
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function cancel()
    {
        throw new IllegalStateTransitionException;
    }
}

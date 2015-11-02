<?php namespace App\Http\Statemachine;
interface DeliveryState
{
    public function start();
    public function request();
    public function separate();
    public function collect();
    public function dispatch();
    public function deliver();
    public function giveback();
    public function release();
    public function cancel();
}

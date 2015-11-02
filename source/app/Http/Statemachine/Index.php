<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 * @author marrselo
 */
require "autoload.php";

//require __DIR__ . '/src/autoload.php';

$delivery = new Delivery(new WaitingDeliveryState());
var_dump($delivery->start());
var_dump($delivery->isWaiting());
//var_dump($delivery->separate());
var_dump($delivery->collect());

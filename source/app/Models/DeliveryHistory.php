<?php namespace App\Models;


class DeliveryHistory extends BaseModel
{

    /**
     * The database table used by the model.
     *
     * @var string
     */

    protected $fillable = ['delivery_id', 'delivery_history_id' , 'event', 'flagactive'];
    
    protected $table = 'delivery_history';

}
<?php namespace App\Models;

class Delivery extends BaseModel
{
    const WAITING = 1;
    const REQUESTED = 2;
    const RESERVED = 3;
    const COLLECTING = 4;
    const INROUTE = 5;
    const DELIVERED = 6;
    const FINISHED = 7;
    const RETURNED = 8;
    const CANCELED = 9;
    
    protected $fillable = ['id', 'customer_id', 'delivery_state_id', 'paymenttype_id', 'category_id', 'vehicletype_id', 
        'driver_id', 'number_points', 'delivery_type_id', 'datestart', 'datepublish', 'dateseparate', 'flagservice', 
        'flagreturn', 'flagactive','description','price','code','category_other','pay','numberhour'];
    
    public function routes() {
        return $this->hasMany('Route');
    }
}
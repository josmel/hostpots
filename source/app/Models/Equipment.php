<?php namespace App\Models;

class Equipment extends BaseModel  {

    protected $fillable = ['customer_id','phone','name', 'cellphone', 'flagactive', 'email'];
     protected $table = 'equipments';
}
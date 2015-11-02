<?php namespace App\Models;

class Contact extends BaseModel  {

    protected $fillable = ['customer_id','phone','name', 'cellphone', 'flagactive', 'email'];
    
}
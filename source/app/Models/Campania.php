<?php namespace App\Models;

class Campania extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description', 'flagactive','customer_id'];
    protected $table = 'campania';

}
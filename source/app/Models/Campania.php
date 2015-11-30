<?php namespace App\Models;

class Campania extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','url', 'expiracion','customer_id','megas','imagen'];
    protected $table = 'campania';

}
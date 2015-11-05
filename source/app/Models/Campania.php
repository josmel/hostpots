<?php namespace App\Models;

class Campania extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description', 'flagactive'];
    protected $table = 'campania';

}
<?php namespace App\Models;

class Setting extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['day_id','equipment_campania_id'];
    protected $table = 'settings';

}
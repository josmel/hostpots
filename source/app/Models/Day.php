<?php namespace App\Models;

class Day extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','flagactive'];
    protected $table = 'day';

}
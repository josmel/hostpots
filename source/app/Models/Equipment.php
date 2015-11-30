<?php namespace App\Models;

class Equipment extends BaseModel  {
  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','mac', 'flagactive','ip','groups_id'];
    protected $table = 'hotspots';
}
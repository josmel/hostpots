<?php namespace App\Models;

class DriverState extends BaseModel
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

    protected $dates = ['lastupdate', 'datecreate', 'datedelete'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name','flagactive', 'lastupdate', 'datecreate', 'datedelete'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'driver_states';
}
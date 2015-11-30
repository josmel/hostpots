<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Hostpots extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','mac', 'flagactive','geocode','owner'];
    protected $table = 'hotspots';
       public $timestamps = false;

}
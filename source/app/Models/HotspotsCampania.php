<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class HotspotsCampania extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['hotspots_id','campania_id','day_id'];
    protected $table = 'hotspots_campania';
       public $timestamps = false;

}
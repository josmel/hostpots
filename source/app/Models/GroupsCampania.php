<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class GroupsCampania extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['groups_id','campania_id','day_id'];
    protected $table = 'group_campania';
       public $timestamps = false;

}
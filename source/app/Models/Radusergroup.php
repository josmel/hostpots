<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Radusergroup extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username','groupname', 'priority'];
    protected $table = 'radusergroup';
       public $timestamps = false;

}

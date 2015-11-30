<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Radgroupreply extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['groupname','attribute', 'op','value'];
    protected $table = 'radgroupreply';
       public $timestamps = false;

}
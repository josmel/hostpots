<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Radcheck extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['username','attribute', 'op','value'];
    protected $table = 'radcheck';
    public $timestamps = false;
}
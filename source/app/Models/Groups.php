<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Groups extends Model  {

    protected $fillable = ['customer_id','name','description','flagactive'];
     protected $table = 'groups';
        public $timestamps = false;
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotspotsGroups extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['hotspots_id', 'groups_id', 'flagactive'];
    protected $table = 'hotspots_groups';
    public $timestamps = false;

}

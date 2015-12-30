<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingHotspots extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['hotspots_campania_id', 'day_id'];
    protected $table = 'setting_hotspots';
    public $timestamps = false;

}

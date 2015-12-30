<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingGroups extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['group_campania_id', 'day_id'];
    protected $table = 'setting_groups';
    public $timestamps = false;

}

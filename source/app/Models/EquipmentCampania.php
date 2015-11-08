<?php namespace App\Models;

class EquipmentCampania extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['campania_id','equipment_id','flagactive','datestart','datefinal'];
    protected $table = 'equipment_campania';

}
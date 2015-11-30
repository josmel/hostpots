<?php

namespace App\Models;

use DB;

class EquipmentCampania extends BaseModel {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['campania_id', 'equipment_id', 'flagactive', 'datestart', 'datefinal'];
    protected $table = 'equipment_campania';

    public function obtenerDetalleCampania($id) {
        $tabla = DB::table($this->table)
                        ->join('equipments', 'equipment_campania.equipment_id', '=', 'equipments.id')
                        ->join('campania', 'equipment_campania.campania_id', '=', 'campania.id')
                        ->select('equipment_campania.id', 'campania.name as nameCampania', 'campania.description as nameDescription')
                        ->Where('equipments.id', '=', $id)
                        ->Where('equipments.flagactive', '=', '1')->get();

        return $tabla;
    }

}

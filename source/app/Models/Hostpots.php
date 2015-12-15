<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Hostpots extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'mac', 'flagactive', 'geocode', 'owner','email_owner','manager'];
    protected $table = 'hotspots';
    public $timestamps = false;

    public function listHotspots($idUser,$name) {
        $HotsPotsGroups = DB::select("select DISTINCT H.id from hotspots as H "
                        . "inner join hotspots_groups as HG ON H.id=HG.hotspots_id "
                        . "where H.geocode=$idUser");
        if ($HotsPotsGroups) {
            foreach ($HotsPotsGroups as $value) {
                $idHotspots[] = $value->id;
            }
            $Hostpots = Hostpots::whereNotIn('id', $idHotspots)->whereGeocode($idUser)->lists($name, 'id','geocode');
        } else {
            $Hostpots = Hostpots::whereGeocode($idUser)->lists($name, 'id','geocode');
        }
        return $Hostpots;
    }

}

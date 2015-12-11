<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model,
    DB;

class Groups extends Model {

    protected $fillable = ['customer_id', 'name', 'description', 'flagactive'];
    protected $table = 'groups';
    public $timestamps = false;

    public function getGroupsDataTable($idUser) {
        $data = $this->select(['groups.id', 'groups.name', DB::raw("(if(flagactive='1','Activo',(if(flagactive='0','Inactivo','-')))) as flagactive"), 'groups.customer_id'
                        ])
                        ->where('groups.customer_id', '=', $idUser)
                        ->where('groups.flagactive', '=', '1')->
                        orderBy('groups.id', 'desc')->get();
        return $data;
    }

    /* public function getGroupsDataTable($idUser) {
      $data = $this->select(['groups.id', 'groups.name', 'groups.flagactive', 'groups.customer_id',
      DB::raw("(select group_concat(H.name, concat('*',H.id)) from hotspots_groups as HG "
      . "inner join hotspots as H ON H.id=HG.hotspots_id inner join groups as G ON G.id=HG.groups_id "
      . "where  HG.flagactive=1 and G.flagactive=1 and HG.groups_id=G.id "
      . "group by G.id) as hotspots")
      ])
      ->where('groups.customer_id', '=', $idUser)
      ->where('groups.flagactive', '=', '1')->get()
      ;
      return $data;
      } */
}

<?php namespace App\Models;

class Route extends BaseModel  {

    protected $fillable = ['delivery_id','contact_id','coordenate', 'order_route', 'flagactive', 'idubigeo',
        'address','description','contact_name','contact_phone','contact_cellphone','contact_email','flag_destino'];
    
    public function deliveries()
    {
        return $this->belongsTo('Delivery');
    }
    
}
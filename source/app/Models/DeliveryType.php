<?php
/**
 * Created by PhpStorm.
 * User: netmaster
 * Date: 9/18/15
 * Time: 10:46 AM
 */

namespace App\Models;


class DeliveryType extends BaseModel
{

    /**
     * The database table used by the model.
     *
     * @var string
     */

    protected $fillable = ['id', 'description', 'name', 'flagactive', 'lastupdate', 'datecreate', 'datedelete'];
    
    protected $table = 'delivery_type';

}
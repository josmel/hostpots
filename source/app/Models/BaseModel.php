<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class BaseModel extends Model
{

    use SoftDeletes;

    /**
     * The name of the "created at" column.
     *
     * @var string
     */


    const CREATED_AT = 'datecreate';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'lastupdate';

    /**
     * The name of the "deleted at" column.
     *
     * @var string
     */
    
    const DELETED_AT = 'datedelete';
    
    protected $dates = ['datedelete'];
    
    protected $hidden = ['datedelete'];

}
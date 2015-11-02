<?php namespace App\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    const CREATED_AT = 'datecreate';
    const UPDATED_AT = 'lastupdate';
    const DELETED_AT = 'datedelete';
    protected $dates = ['datedelete'];
    protected $hidden = ['datedelete'];
}
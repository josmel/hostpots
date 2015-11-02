<?php namespace App\Models;

class Notification extends BaseModel  {

    const PUSH = 1;
    const EMAIL = 2;
    const SMS = 3;
    
    protected $connection = 'mysql_notification';
    
    protected $fillable = ['type_id','platform_id','user_id','app_id','token','description',
        'appname','dbconfig','params','tosend','to','from','flagsend','flagactive'];
    
}
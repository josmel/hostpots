<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Driver extends BaseModel implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable,
        CanResetPassword,
        EntrustUserTrait;

    protected $fillable = ['namedriver', 'lastname', 'flagbussy', 'phone', 'flagactive', 'password','dni',
        'email', 'uuid', 'driver_state_id', 'vehicletype_id','picture','placa_vehicle'];
    protected $hidden = ['password'];

   
    public function getRememberToken()
    {
        return null; // not supported
    }

    public function setRememberToken($value)
    {
      // not supported
    }

    public function getRememberTokenName()
    {
        return null; // not supported
    }

    public function setAttribute($key, $value)
    {
           $isRememberTokenAttribute = $key == $this->getRememberTokenName();
           if (!$isRememberTokenAttribute)
           {
             parent::setAttribute($key, $value);
           }
    }
}

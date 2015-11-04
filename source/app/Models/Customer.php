<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Customer extends BaseModel implements AuthenticatableContract, CanResetPasswordContract  {
    
    use Authenticatable, CanResetPassword, EntrustUserTrait;

    protected $fillable = ['company_id','ruc','phone','name_customer', 'lastname', 
        'flagactive', 'password', 'email','credit','address','latitude','longitude','referencia'];
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
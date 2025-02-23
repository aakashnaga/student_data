<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements AuthenticatableContract, JWTSubject
{
    use Authenticatable; 

    protected $collection = 'users';
    protected $fillable = ['name', 'email', 'password', 'role', 'deleted_at'];

    protected $hidden = ['password'];

    public function getJWTIdentifier()
    {
        return (string) $this->_id;
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}

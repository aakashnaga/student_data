<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Storage;

class User extends Model implements AuthenticatableContract, JWTSubject
{
    use Authenticatable; 

    protected $collection = 'newusers';
    protected $fillable = ['name', 'email', 'password', 'subjects', 'age', 'address', 'image', 'document'];

    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : null;
    }

    public function getDocumentUrlAttribute()
    {
        return $this->document ? Storage::url($this->document) : null;
    }

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

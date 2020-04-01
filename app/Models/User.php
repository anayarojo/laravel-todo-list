<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends BaseModel implements JWTSubject
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id')->whereDeleted(false);
    }

    public function groups()
    {
        return $this->hasMany(Group::class)->whereDeleted(false);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class)->whereDeleted(false);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}

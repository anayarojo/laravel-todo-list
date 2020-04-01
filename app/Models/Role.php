<?php

namespace App\Models;

class Role extends BaseModel
{
    protected $columns = [
        'id',
        'name',
        'description',
        'created_at',
        'updated_at',
        'disabled',
        'protected',
        'deleted',
    ];

    protected $fillable = [
        'name',
        'description',
    ];

    protected $casts = [
        'disabled'  => 'boolean',
        'protected' => 'boolean',
        'deleted'   => 'boolean',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles', 'role_id', 'user_id');
    }
}

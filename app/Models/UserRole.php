<?php

namespace App\Models;


class UserRole extends BaseModel
{
    protected $columns = [
        'id',
        'user_id',
        'role_id',
        'created_at',
        'updated_at',
        'disabled',
        'protected',
        'deleted',
    ];

    protected $fillable = [
        'user_id',
        'role_id',
    ];

    protected $casts = [
        'disabled'  => 'boolean',
        'protected' => 'boolean',
        'deleted'   => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function role()
    {
        return $this->belongsTo(User::class);
    }
}

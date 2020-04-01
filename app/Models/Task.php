<?php

namespace App\Models;

class Task extends BaseModel
{
    protected $columns = [
        'id',
        'user_id',
        'group_id',
        'description',
        'completed',
        'created_at',
        'updated_at',
        'disabled',
        'protected',
        'deleted',
    ];

    protected $fillable = [
        'user_id',
        'group_id',
        'description',
        'completed',
    ];

    protected $casts = [
        'completed'  => 'boolean',
        'disabled'  => 'boolean',
        'protected' => 'boolean',
        'deleted'   => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}

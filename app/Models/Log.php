<?php

namespace App\Models;

class Log extends BaseModel
{
    protected $columns = [
        'id',
        'user_id',
        'before',
        'after',
        'created_at',
        'updated_at',
        'disabled',
        'protected',
        'deleted',
    ];

    protected $fillable = [
        'user_id',
        'before',
        'after',
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

    public function model()
    {
        return $this->morphTo('model');
    }
}

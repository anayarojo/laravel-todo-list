<?php

namespace App\Models;

class Group extends BaseModel
{
    protected $columns = [
        'id',
        'user_id',
        'parent_id',
        'name',
        'description',
        'created_at',
        'updated_at',
        'disabled',
        'protected',
        'deleted',
    ];

    protected $fillable = [
        'user_id',
        'parent_id',
        'name',
        'description',
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

    public function parent()
    {
        return $this->belongsTo(Group::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Group::class, 'parent_id')->whereDeleted(false);
    }

    public function lists()
    {
        return $this->groups()->whereNotNull('parent_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class)->whereDeleted(false);
    }
}

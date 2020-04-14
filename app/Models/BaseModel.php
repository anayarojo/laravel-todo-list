<?php

namespace App\Models;

use App\Interfaces\QueryFilter;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

abstract class BaseModel extends Authenticatable
{
    use Notifiable;

    protected $hidden = [
        'deleted',
        'protected',
    ];

    protected $casts = [
        'disabled'  => 'boolean',
        'protected' => 'boolean',
        'deleted'   => 'boolean',
    ];

    public static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            $model->saveLog();
        });
    }

    public function logs()
    {
        return $this->morphMany(Log::class, 'model')->whereDeleted(false);
    }

    public function saveLog($userId = null, $diff = null)
    {
        if (Auth::id())
        {
            $diff = $diff ?: $this->getDiff();
            return $this->logs()->create([
                'user_id' => Auth::id() ?: $userId,
                'before'  => $diff[ 'before' ],
                'after'   => $diff[ 'after' ],
            ]);
        }
    }

    protected function getDiff()
    {
        $changed = $this->getDirty();
        $before = json_encode(array_intersect_key($this->fresh()->toArray(), $changed));
        $after = json_encode($changed);
        return compact('before', 'after');
    }

    public function scopeFilter($query, QueryFilter $filters)
    {
        return $filters->apply($query);
    }
}

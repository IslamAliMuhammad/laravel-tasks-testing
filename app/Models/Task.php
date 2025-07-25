<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    
    protected $fillable = ['title', 'description', 'is_done'];

    /**
     * Get the task's title.
     */
    public function getTitleAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Scope a query to only include completed tasks.
     */
    public function scopeCompleted($query)
    {
        return $query->where('is_done', true);
    }

    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'description', 'status', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the task's title.
     */
    public function getTitleAttribute($value)
    {
        return ucfirst($value);
    }
  
    public function getIsCompletedAttribute()
    {
        return $this->status === 'done';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'priority',
        'is_completed',
        'due_date'
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'due_date' => 'date'
    ];

    // Custom method
    public function markAsCompleted()
    {
        $this->is_completed = true;
        $this->save();
    }

    // Scope for filtering
    public function scopePending($query)
    {
        return $query->where('is_completed', false);
    }
}

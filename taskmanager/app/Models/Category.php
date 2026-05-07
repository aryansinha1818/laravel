<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    // One-to-Many: Category has many tasks
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // Accessor
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    // Mutator
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
        $this->attributes['slug'] = \Illuminate\Support\Str::slug($value);
    }
}

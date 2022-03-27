<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function details()
    {
        return $this->hasMany(TodoDetail::class, 'todo_id');
    }
}

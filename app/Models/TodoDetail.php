<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoDetail extends Model
{
    use HasFactory;
    protected $fillable = ['name','todo_id','order_id'];

    public function subDetail(){
        return $this->hasMany(TodoDetail::class, 'todo_id', 'id');
    }
}

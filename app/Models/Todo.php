<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $table = 'to_do_list';
    protected $fillable = ['title', 'status'];
}
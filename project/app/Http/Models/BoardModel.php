<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class BoardModel extends Model
{
    protected $table = 'board_models';
    protected $fillable = ['id', 'topic', 'detail', 'user_id', 'created_at', 'updated_at'];
}

<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $fillable = ['id', 'name', 'password','status', 'room_id'];
}

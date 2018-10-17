<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class RoomModel extends Model
{
    protected $table = 'rooms';
    protected $fillable = ['id','roomer','cost','rent','ap_id'];
}

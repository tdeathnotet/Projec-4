<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class BillModel extends Model
{
    protected $table = 'bills';
    protected $fillable = ['id', 'month', 'year', 'room_id', 'ap_id','bwater_number', 'belect_number','water_number', 'elect_number','note', 'created_at', 'updated_at'];
}

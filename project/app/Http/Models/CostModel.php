<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class CostModel extends Model
{
    protected $table = 'costs';
    protected $fillable = ['name','price','detail'];
}

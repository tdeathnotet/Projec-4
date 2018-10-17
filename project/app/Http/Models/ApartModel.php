<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ApartModel extends Model
{
    protected $table = 'aparts';
    protected $fillable = ['name','shname','detail','elect','water'];
}

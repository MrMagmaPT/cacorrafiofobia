<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $table = 'stats';
    protected $fillable = ['mana','defence','magic','Inte','Ma','Uc','Lu','Com','Agi','Str','Md','Con','Res'];
}

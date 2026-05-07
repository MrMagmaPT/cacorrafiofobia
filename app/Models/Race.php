<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $table = 'races';
    protected $fillable = ['name'];

    public function characters() {
        return $this->hasMany(CharacterProfile::class, 'race_id');
    }

    public function subRaceCharacters() {
        return $this->hasMany(CharacterProfile::class, 'subrace_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerClass extends Model
{
    protected $table = 'player_classes';
    protected $fillable = ['name'];

    public function characters() {
        return $this->hasMany(CharacterProfile::class, 'class_id');
    }

    public function subClassCharacters() {
        return $this->hasMany(CharacterProfile::class, 'subclass_id');
    }
}

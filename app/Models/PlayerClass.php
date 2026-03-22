<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PlayerClass extends Model
{
    use HasFactory;

    protected $table = 'player_classes';

    protected $fillable = [
        'name',
    ];

    public function characters(): HasMany
    {
        return $this->hasMany(PlayerCharacter::class, 'class_id');
    }

    public function subclassCharacters(): HasMany
    {
        return $this->hasMany(PlayerCharacter::class, 'subclass_id');
    }
}


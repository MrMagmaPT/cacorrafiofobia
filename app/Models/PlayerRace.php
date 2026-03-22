<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PlayerRace extends Model
{
    use HasFactory;

    protected $table = 'player_races';

    protected $fillable = [
        'name',
    ];

    public function characters(): HasMany
    {
        return $this->hasMany(PlayerCharacter::class, 'race_id');
    }

    public function subraceCharacters(): HasMany
    {
        return $this->hasMany(PlayerCharacter::class, 'subrace_id');
    }
}


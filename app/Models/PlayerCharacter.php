<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlayerCharacter extends Model
{
    use HasFactory;

    protected $table = 'player_characters';

    protected $fillable = [
        'laravel_user_id',
        'age',
        'name',
        'race_id',
        'subrace_id',
        'class_id',
        'subclass_id',
        'lvl',
        'alignment',
        'mana',
        'defence',
        'magic',
        'int_stat',
        'ma',
        'uc',
        'lu',
        'com',
        'agi',
        'str_stat',
        'md',
        'con',
        'res',
        'money',
        'hp',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'laravel_user_id');
    }

    public function race(): BelongsTo
    {
        return $this->belongsTo(PlayerRace::class, 'race_id');
    }

    public function subrace(): BelongsTo
    {
        return $this->belongsTo(PlayerRace::class, 'subrace_id');
    }

    public function playerClass(): BelongsTo
    {
        return $this->belongsTo(PlayerClass::class, 'class_id');
    }

    public function subclass(): BelongsTo
    {
        return $this->belongsTo(PlayerClass::class, 'subclass_id');
    }

}


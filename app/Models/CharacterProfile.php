<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CharacterProfile extends Model
{
    protected $table = 'character_profiles';
    protected $fillable = [
        'u_age', 'u_name', 'race_id', 'subrace_id', 'class_id', 'subclass_id', 'LVL', 'aligment', 'money', 'hp', 'stats_id'
    ];

    public function race() {
        return $this->belongsTo(Race::class, 'race_id');
    }

    public function subRace() {
        return $this->belongsTo(Race::class, 'subrace_id');
    }

    public function playerClass() {
        return $this->belongsTo(PlayerClass::class, 'class_id');
    }

    public function subClass() {
        return $this->belongsTo(PlayerClass::class, 'subclass_id');
    }

    public function stats() {
        return $this->hasOne(Stat::class, 'id', 'stats_id');
    }
}

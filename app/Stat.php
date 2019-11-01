<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    //
    public function characters()
    {
        return $this->belongsToMany(Character::class, 'character_stat');
    }
}

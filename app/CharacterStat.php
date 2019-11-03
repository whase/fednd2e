<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CharacterStat extends Model
{
    protected $attributes = [
        'value' => 0,
        'status' => "neutral",
    ];
}

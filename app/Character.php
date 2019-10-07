<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    //
    protected $fillable = ['name'];

    protected $attributes = [
        'level' => 1,
        'stars' => 0,
        'notes' => "",
        'favorite' => false,
    ];
}

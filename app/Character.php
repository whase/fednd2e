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
    public function stats()
    {
        return $this->belongsToMany(Stat::class, 'character_stat')->withPivot('value', 'status');
    }

    public function campaign(){
        return $this->belongsTo(Campaigns::class, 'campaign_id');

    }

}

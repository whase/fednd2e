<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaigns extends Model
{


    public function characters(){
        return $this->hasMany(Character::class, 'campaign_id');

    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    /**
    * Provides a many-to-many relationship with Users
     **/
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

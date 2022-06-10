<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    public function posts(){
        return $this-> belongsToMany('App\Models\Post');
    }
}

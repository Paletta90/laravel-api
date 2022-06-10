<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'category_id', 'title', 'slug', 'content', 'image', 'firm'
    ];

    public function Category(){
        return $this -> belongsTo('App\Models\Category');
    }

    public function platforms(){
        return $this -> belongsToMany('App\Models\Platform');
    }
}

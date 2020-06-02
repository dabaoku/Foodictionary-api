<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    //
    protected $fillable = ['recipe_name', 'recipe_total_time', 'recipe_description','recipe_note', 'recipe_level','recipe_video','recipe_image'];

    public function recipe_ingredient(){
        return $this->hasMany(Recipe_ingredient::class);
    }
}

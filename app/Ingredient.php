<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    //
    public function recipe_ingredient(){
        return $this->hasMany(Recipe_ingredient::class);
    }
}

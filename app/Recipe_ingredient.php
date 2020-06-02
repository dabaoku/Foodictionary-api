<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe_ingredient extends Model
{
    //
    public function recipe(){
        return $this->belongsTo(Recipe::class);
    }

    public function ingredient(){
        return $this->belongsTo(Ingredient::class);
    }
}

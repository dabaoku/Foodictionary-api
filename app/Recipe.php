<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    //
    protected $fillable = ['recipe_name', 'recipe_total_time', 'recipe_description','recipe_note','recipe_video'];
}

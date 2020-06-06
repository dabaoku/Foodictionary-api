<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    //
    protected $fillable = ['member_id', 'ingredient_id', 'stock_depositday'];
}

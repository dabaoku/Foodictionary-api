<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe_ingredient;

class Recipe_ingredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response(['data' => Recipe_ingredient::get()]);

    }

    // TODO:還沒做新增食譜食材api
    
}

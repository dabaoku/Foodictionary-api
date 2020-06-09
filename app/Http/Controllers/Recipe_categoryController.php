<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe_category;

class Recipe_categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        {
            return response(['data' => Recipe_category::get()]);
        }
    }
}

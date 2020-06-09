<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategorysController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        {
            return response(['data' => Category::get()]);
        }
    }
}

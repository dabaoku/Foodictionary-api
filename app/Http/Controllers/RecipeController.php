<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Recipe;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all recipe
        return response(['data' => Recipe::get()]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // create new recipe
        $rules = [
            'recipe_name' => 'required|string|min:2|max:255',
            'recipe_total_time' => 'int|required',
            'recipe_description' => 'string|required|max:255',
            'recipe_note' => 'string|required|max:255',
            'recipe_video' => 'string|required|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response(['message' => $validator->errors()],422);
        }

        $data = $request->only(['recipe_name', 'recipe_total_time', 'recipe_description','recipe_note','recipe_video']);
        
        $post = Recipe::create($data);
        return response(['data' => $post]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // find one recipe
        $post = Recipe::find($id);

        if(!is_null($post)){
            return response(['data' => $post]);
        }

        return response(['message' => 'Recipe not found']);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

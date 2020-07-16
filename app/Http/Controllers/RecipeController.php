<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Recipe;
use App\Recipe_ingredient;
use App\Ingredient;
use App\Step;
use DB;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get 所有的食譜及對應的步驟
        $data = DB::table('recipes')
                ->join('steps','steps.recipe_id','=','recipes.id')
                ->select('recipes.id', 'recipes.recipe_name',
                'recipes.recipe_total_time',
                'recipes.recipe_description',
                'recipes.recipe_note',
                'recipes.recipe_level',
                'recipes.recipe_video',
                'recipes.recipe_image',
                'steps.step',
                'steps.step_prescription',
                'steps.step_time')
                ->get();
        return response(['data' => $data]);
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRecipeAndIngredient()
    {
        // get 所有的食譜及食材
        $data = DB::table('ingredients')
                ->join('recipe_ingredients','recipe_ingredients.ingredient_id','=','ingredients.ingredient_id')
                ->join('recipes','recipes.id','=','recipe_ingredients.recipe_id')
                ->select(
                'ingredients.ingredient_name',
                'ingredients.ingredient_id',
                'recipes.recipe_name',
                'recipes.id')
                ->get();
        return response(['data' => $data]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allRecipe()
    {
        // get 所有的食譜
        $data = Recipe::select('recipes.id', 'recipes.recipe_name',
                'recipes.recipe_total_time',
                'recipes.recipe_description',
                'recipes.recipe_note',
                'recipes.recipe_level',
                'recipes.recipe_video',
                'recipes.recipe_image')
                ->get();
        return response(['data' => $data]);
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
        // $rules = [
        //     'recipe_name' => 'required|string|min:2|max:255',
        //     'recipe_total_time' => 'int|required',
        //     'recipe_description' => 'string|required|max:255',
        //     'recipe_note' => 'string|required|max:255',
        //     'recipe_video' => 'string|required|max:255',
        //     'step' => 'required|int|max:200',
        //     'step_prescription' => 'string|required|max:255',
        //     'step_time' => 'int|max:200',
        // ];

        // 新增該食譜的資料
        $rules = [
            'recipe_name' => 'required|string|min:2|max:255',
            'recipe_total_time' => 'int|required',
            'recipe_description' => 'string|required|max:255',
            'recipe_note' => 'string|required|max:255',
            'recipe_level' => 'string|required|max:8',
            'recipe_video' => 'string|required|max:255',
            'recipe_image' => 'string|required|max:255'
        ];


        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response(['message' => $validator->errors()],422);
        }

        
        $recipe_data = $request->only(['recipe_name', 'recipe_total_time', 'recipe_description','recipe_note', 'recipe_level','recipe_video','recipe_image']);
        $recipe = Recipe::create($recipe_data);
        return response(['recipe' => $recipe],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //傳入食譜id，他會回傳該食譜及他所有步驟
        $recipe = Recipe::where(['id' => $id])->get();
        $ingredient = DB::table('recipe_ingredients')
        ->join('ingredients','ingredients.ingredient_id','=','recipe_ingredients.ingredient_id')
        ->select('ingredients.ingredient_id',
        'ingredients.ingredient_name',
        'recipe_ingredients.ingredient_amount')
        ->where('recipe_ingredients.recipe_id',$id)
        ->get();


        $step = Step::where('recipe_id',$id)->select('step','step_prescription','step_time')->get();

        
        //如果沒有該食譜id，則回傳422
        if($recipe->count()==0){
            return response(['message' => 'Recipe not found'],422);
        }

        return response(['recipe' => $recipe, 'ingredient' => $ingredient , 'step' => $step],200);
    }
}

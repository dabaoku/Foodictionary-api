<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Step;

class StepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all step
        return response(['data' => Step::get()]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //create new step
        $rules = [
            'recipe_id' => 'required',
            'step' => 'required|int|max:20',
            'step_prescription' => 'string|required|max:255',
            'step_time' => 'int|max:20',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response(['message' => $validator->errors()],422);
        }

        $data = $request->only(['recipe_id', 'step', 'step_prescription', 'step_time']);
        
        $step = Step::create($data);
        return response(['data' => $step]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $recipe_id
     * @return \Illuminate\Http\Response
     */
    public function show($recipe_id)
    {
        // get one recipe all step
        $step = Step::where('recipe_id',$recipe_id)->get();

        if(!is_null($step)){
            return response(['data' => $step]);
        }
        
        return response(['message' => 'step not found'],422);
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

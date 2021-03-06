<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Step;

class StepController extends Controller
{
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

}

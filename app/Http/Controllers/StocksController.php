<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Ingredient;
use App\Stock;
use DB;

class StocksController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //傳入user id，他會回傳該冰箱擁有的東西
        $stock = DB::table('stocks')
        ->join('ingredients','ingredients.ingredient_id','=','stocks.ingredient_id')
        ->select('stocks.member_id',
        'ingredients.ingredient_id',
        'ingredients.ingredient_name',
        'ingredients.ingredient_picture',
        'stocks.stock_depositday')
        ->where('stocks.member_id',$id)
        ->get();

        //如果該user冰箱沒有東西，則回傳422
        if($stock->count()==0){
            return response(['message' => 'You dont have stock'],422);
        }

        return response(['stock' => $stock],200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 新增該食譜的資料
        $rules = [
            'member_id' => 'required',
            'ingredient_id' => 'required',
            'stock_depositday' => 'required',
        ];


        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response(['message' => $validator->errors()],422);
        }

        
        $stock_data = $request->only(['member_id', 'ingredient_id', 'stock_depositday']);
        $stock = Stock::create($stock_data);
        return response(['stock' => $stock],200);
    }


    /**
     * @param  int $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 傳入stock_id，來刪除該筆資料
        $stock = DB::table('stocks')->where('stock_id', '=', $id)->get();
        if($stock->count()==0){
            return response(['message' => 'stock not found!'],422);
        }
        DB::table('stocks')->where('stock_id', '=', $id)->delete();
        return response(['stock deleted' => $stock],200);
        
    }
    


}

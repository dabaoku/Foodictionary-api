<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class UsersController extends Controller
{      

/**
 * 用戶註冊
 */
   public function register(Request $request)
    {
        // 驗證 client 端輸入
        $rules = [
            'member_name' => ['required', 'string', 'min:2', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'max:20', 'confirmed'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response(['message' => $validator->errors()],422);
        }
        
        // 預設值插入
        $data = $request->all();
        // 密碼雜湊
        $data['password'] = Hash::make($data['password']);
        $data['api_token'] = Str::random(60);
        $user = User::create($data);
        return response(['data' => $user, 'api_token' => $user->api_token]);

    }
/**
 * 用戶登入
 */
    public function login(Request $request){
        $email = $request -> auth_email;
        $password = $request -> auth_password;

        $user = User::where('email',$email) -> first();
        // 判斷登入email是否存在資料庫，在response的第二個參數可以回傳server status，default是200
        if(!$user){
            return response(['message' => 'Login failed. Please check your email'],422);
        }
        // 判斷密碼是否正確
        if(!Hash::check($password, $user -> password)){
            return response(['message' => 'Login failed. Please check your password'],422);
        }

        // 如果資料正確，回傳successful message
        return response(['message' => 'Login successfully.' , 
        'member_id' => $user -> member_id,
        'member_name' => $user -> member_name,
        'email' => $user -> email,
        'api_token' => $user -> api_token]);
    }
}
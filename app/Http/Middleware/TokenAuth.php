<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
class TokenAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 確認 Http Header 的 token 有無對應的使用者
        $api_token = request()->header('api_token');
        $auth_user = User::where('api_token', $api_token)->get();

        if(!count($auth_user)){
            return response(['message' => 'Authentication error']);
        }

        // 將通過驗證的使用者存放於 attribute 裡以便將變數傳給 controller
        $request->attributes->set('auth_user', $auth_user);
        return $next($request);
    }
}
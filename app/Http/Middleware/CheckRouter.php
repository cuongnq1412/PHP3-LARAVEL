<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;
use Illuminate\Http\Request;

class CheckRouter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {


        if(Auth::check()){
            if(Auth::user()->role == 'admin'){
                if(Auth::user()->status == 1){
                    return $next($request);
                }else{
                    Auth::logout();
                    return redirect('/')->with('alert',[
                       'type'=>'error',
                       'message'=>' Tài khoản của bạn đã bị khóa vui lòng liên hệ 0773311371 để biết thêm chi tiết !'
               ]);

                }
            }
        }


        // return $next($request);
        return redirect('login');
    }
}

<?php

namespace App\Http\Middleware;


use Illuminate\Support\Facades\Auth;

use Closure;
use Illuminate\Http\Request;

class Checkuser
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
       if(Auth::user()->status == 0){
        Auth::logout();
        return redirect()->back()->with('alert',[
           'type'=>'error',
           'message'=>' Tài khoản của bạn đã bị khóa vui lòng liên hệ 0773311371 để biết thêm chi tiết !'
   ]);
   }}


        return $next($request);
    }
}

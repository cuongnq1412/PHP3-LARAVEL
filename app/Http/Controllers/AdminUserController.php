<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class AdminUserController extends Controller
{
    public function listusers(){
        $data= DB::table('users')->get();
        return view('admin.listusers',['data'=>$data]);
    }
    public function upstatususer(Request $request, $id)  {
        $query=DB::table('users')->where('id',$id)->first();
        $data = $request->validate([
            'status' => 'required|in:0,1',
        ]);

        if($query){
            $up = DB::table('users')
            ->where('id',$id)
            ->update([
                'status'=>$data['status']
            ])
            ;
            return redirect()->back();
        }

    }
}

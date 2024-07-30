<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function addcomment(Request $request){
        $validatedData=$request->validate([
            'user_id'=>'required|integer|max:100',
            'article_id'=>'required|integer|max:100',
            'comment'=>'required|string|max:500',
            'status_cmt'=>'required|integer|max:11',
        ]);
        $query=DB::table('comments')->insert([
            'user_id'=>$validatedData['user_id'],
            'article_id'=>$validatedData['article_id'],
            'comment'=>$validatedData['comment'],
            'status_cmt'=>$validatedData['status_cmt'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->back();
    }
    public function listcomments(){
        $query=Comment::getall();
        return view('admin.listcomments',['data'=>$query]);
    }
    public function upstatuscmt(Request $request, $id)  {
        $query=DB::table('comments')->where('id',$id)->first();
        $data = $request->validate([
            'status_cmt' => 'required|in:0,1',
        ]);

        if($query){
            $up = DB::table('comments')
            ->where('id',$id)
            ->update([
                'status_cmt'=>$data['status_cmt']
            ])
            ;
            return redirect()->back();
        }

    }
}

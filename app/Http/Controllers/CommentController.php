<?php

namespace App\Http\Controllers;
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
}

<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public static function getcomment($id) {
        return DB::table('comments')
        ->leftJoin('users' , 'comments.user_id','=','users.id')
        ->select('comments.*' , 'users.name as name')
        ->where('comments.article_id',$id)
        ->where('comments.status_cmt', 1)
        ->orderBy('comments.created_at', 'desc')
        ->paginate(5);

    }
    public static function getall() {
        return DB::table('comments')
        ->leftJoin('users' , 'comments.user_id','=','users.id')
        ->leftJoin('articles' , 'comments.article_id','=','articles.id')
        ->select('comments.*' , 'users.name as name' ,'articles.title as title')
        ->get();

    }
    public static function sumcmt($id)  {
        return DB::table('comments')->where('article_id', $id)
        ->count('article_id');

    }
}

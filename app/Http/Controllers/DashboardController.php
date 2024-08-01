<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $sumuser = DB::table('users')->count();
        $sumnews = DB::table('articles')->count();
        $sumviews = DB::table('articles')->sum('views');
        $sumcmt = DB::table('comments')->count();
        $sumctgr = DB::table('categories')->count();

        $list5newsviewshot = DB::table('articles')
        ->leftJoin('comments', 'articles.id', '=', 'comments.article_id')
        ->select('articles.id', 'articles.title', 'articles.image_url', 'articles.views', DB::raw('COUNT(comments.id) as comments_count'))
        ->groupBy('articles.id', 'articles.title', 'articles.image_url', 'articles.views')
        ->orderByDesc('articles.views')
        ->limit(5)
        ->get();
        $list5userhot=DB::table('users')
        ->leftJoin('comments','users.id' ,'=','comments.user_id')
        ->select('users.name','users.created_at', DB::raw('COUNT(comments.id) as comments_count'))
        ->groupBy('users.name','users.created_at')
        ->orderByDesc('comments_count')
        ->limit(5)
        ->get();


       return view('admin.dashboard',
    compact('sumuser','sumnews','sumviews','sumcmt','sumctgr','list5newsviewshot','list5userhot')

    );

    }
}

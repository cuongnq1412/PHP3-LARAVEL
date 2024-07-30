<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
class HomeController extends Controller
{
    public function index(){


    $articles = DB::table('articles')
    ->select('articles.*', 'categories.name as categories_name')
    ->leftJoin('categories', 'articles.category_id', '=', 'categories.id')
    ->orderBy('articles.created_at', 'desc')
    ->get();

    $latestArticle = $articles->first();
    $latest2Article=$articles->slice(5, 4);
    $latest4Articles = $articles->slice(1, 3);
    $next5Articles = $articles->slice(4, 5);

     $startOfWeek = Carbon::now()->startOfWeek();
     $endOfWeek = Carbon::now()->endOfWeek();

     $weeklyArticles = DB::table('articles')
         ->select('articles.*', 'categories.name as categories_name')
         ->leftJoin('categories', 'articles.category_id', '=', 'categories.id')
         ->whereBetween('articles.created_at', [$startOfWeek, $endOfWeek])
         ->orderBy('articles.created_at', 'desc')
         ->limit(4)
         ->get();
    $getcategories=DB::table('categories')
    ->limit(6)
    ->get();

    $categories = DB::table('categories')->take(5)->get();



    return view('home', [
        'data' => $latestArticle,
        'data1' => $latest4Articles,
        'data2' => $next5Articles,
        'data3' => $weeklyArticles,
        'categories' => $getcategories,
        'data4'=>$latest2Article,
        'data5'=>$categories

    ]);


}
}

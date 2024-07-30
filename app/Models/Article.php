<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    use HasFactory;
    protected $table='articles';
    protected $fillable = [
       'id', 'title', 'short_description', 'content', 'author_id', 'category_id',  'image_url'
    ];

    public static function updatepost($id,$data) {
        try {
            return DB::table('articles')->where('id',$id)->update($data);
        } catch (\Throwable $th) {
            Log::error('Error inserting article: ' . $th->getMessage());
            return false;
        }

    }


    public static function store(array $data)
    {


        try {
            return DB::table('articles')->insert($data);
        } catch (\Throwable $th) {
            Log::error('Error inserting article: ' . $th->getMessage());
            return false;
        }



    }
    // public static function update($data, $id){
    //     try {
    //         return DB::table('articles')->where('id', $id)->update($data);
    //     } catch (\Throwable $th) {
    //         Log::error('Error inserting article: ' . $th->getMessage());
    //         return false;
    //     }
    // }
    public static function index()
    {
        return DB::table('articles')
        ->leftJoin('categories', 'articles.category_id', '=', 'categories.id')

        ->select(
            'articles.id',
            'articles.title',
            'articles.short_description',
            'articles.content',
            'articles.author_id',
            'articles.category_id',

            'articles.image_url',
            'articles.views',
            'articles.created_at',
            'categories.name as category_name',

        )
        ->get();
    }
    public static function showid($id)
    {
        return DB::table('articles')
        ->leftJoin('categories', 'articles.category_id', '=', 'categories.id')

        ->select(
            'articles.id',
            'articles.title',
            'articles.keymeta',
            'articles.keytitle',
            'articles.keycontent',
            'articles.short_description',
            'articles.content',
            'articles.author_id',
            'articles.category_id',

            'articles.image_url',
            'articles.views',
            'articles.created_at',
            'categories.name as category_name',

        )
        ->where('articles.id','=',$id)
        ->get();
    }



    public static function getPostById($id)
    {
        // return self::where('id', $id)->first();
        return DB::table('articles')->leftJoin('users', 'articles.author_id','=','users.id')
        ->select('*','users.name as tg_name')->where('articles.id',$id)->first();
    }
}

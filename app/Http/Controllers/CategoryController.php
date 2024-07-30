<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = DB::table('categories')
        ->select('categories.id', 'categories.name', DB::raw('COUNT(articles.id) as total_articles'))
        ->leftJoin('articles', 'categories.id', '=', 'articles.category_id')
        ->groupBy('categories.id', 'categories.name')
        ->get();
        $query1 = DB::table('articles')
        ->select('articles.id', 'articles.title','short_description','image_url' ,DB::raw('COUNT(comments.id) as total_comments'))
        ->leftJoin('comments', 'articles.id', '=', 'comments.article_id')
        ->groupBy('articles.id','articles.title','short_description','image_url')
        ->paginate(3);
        // ->get();


    return view('categories',
         [
        'data' => $query,
        'data1' => $query1
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $query=DB::table('categories')->get();
        return view('admin.category',['data'=>$query]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validatedData=$request->validate([
                'name'=>'required|string|max:100',
                'description'=>'required|string|max:500',
                'img_category'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048'

            ]);
            $imageName = 'img_category'.time().'_'
                                    .$request->name.'.'
                                    .$request->img_category->extension();
            $imagePath = $request->file('img_category')->storeAs('public/categories', $imageName);

            $query=DB::table('categories')->insert([
                'name'=>$validatedData['name'],
                'description'=>$validatedData['description'],
                'img_category'=>'storage/categories/'.$imageName
            ]);
            if($query > 0){
                return redirect()->back()->with('alert', [
                    'type' => 'success',
                    'message' => 'Danh mục đã được thêm thành công!'
                ]);

            }else{
                return redirect()->back()->with('alert', [
                    'type' => 'error',
                    'message' => 'Danh mục không thêm thành công!'
                ]);
            }
        } catch (\Throwable $th) {

            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Có lỗi xảy ra : ' . $th->getMessage()
            ]);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $query = DB::table('categories')
        ->select('categories.id', 'categories.name', DB::raw('COUNT(articles.id) as total_articles'))
        ->leftJoin('articles', 'categories.id', '=', 'articles.category_id')
        ->groupBy('categories.id', 'categories.name')
        ->get();
       $query1 = DB::table('articles')
    ->select('articles.id', 'articles.title', 'articles.short_description', DB::raw('COUNT(comments.id) as total_comments'))
    ->leftJoin('comments', 'articles.id', '=', 'comments.article_id')
    ->where('category_id', $id)
    ->groupBy('articles.id', 'articles.title', 'articles.short_description')
    ->paginate(5);

    // dd(['data'=>$query1]);

    return view('listbaiviet',
         [
        'data' => $query,
        'data1' => $query1
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $query1=DB::table('categories')->get();
        $query=DB::table('categories')->where('id',$id)->first();
        return view('admin.category',['dataid'=>$query,'data'=>$query1]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $check=DB::table('categories')->where('id', $id)->first();
        try {
            $validatedData=$request->validate([
                'name'=>'required|string|max:100',
                'description'=>'required|string|max:500',
                'img_category'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'

            ]);
            if($request->hasFile('img_category')){
                if (file_exists(public_path($check->img_category))) {
                    unlink(public_path($check->img_category));

                }
            $imageName = 'img_category'.time().'_'
                                    .$request->name.'.'
                                    .$request->img_category->extension();
            $imagePath = $request->file('img_category')->storeAs('public/categories', $imageName);
            $img='storage/categories/'.$imageName;
        }else{
            $img=$check->img_category;
        }

            $query=DB::table('categories')->where('id',$id)->update([
                'name'=>$validatedData['name'],
                'description'=>$validatedData['description'],
                'img_category'=>$img
            ]);
            if($query > 0){
                return redirect()->back()->with('alert', [
                    'type' => 'success',
                    'message' => ' Cập nhật thành công !'
                ]);

            }else{
                return redirect()->back()->with('alert', [
                    'type' => 'error',
                    'message' => ' Bạn chưa thay đổi dữ liệu nào !'
                ]);
            }
        } catch (\Throwable $th) {

            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Có lỗi xảy ra : ' . $th->getMessage()
            ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $check =  DB::table('categories')->where('id',$id)->first();
            if ($check) {

                DB::table('articles')->where('category_id', $id)->delete();

                $article2 =  DB::table('categories')->where('id',$id)->delete();

                if (file_exists(public_path($check->img_category))) {
                    unlink(public_path($check->img_category));
                }
                DB::commit();



                // Thông báo thành công
                return redirect()->back()->with('alert',[
                        'type'=>'success',
                        'message'=>'Xóa danh mục thành công !'
                ]);
            }else{
                return redirect()->back()->with('alert', [
                    'type' => 'error',
                    'message' => 'Danh mục không tồn tại.'
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('alert',[
                'type'=>'error',
                'message'=>' Lỗi : '.$th->getMessage()
        ]);
        }
    }
}

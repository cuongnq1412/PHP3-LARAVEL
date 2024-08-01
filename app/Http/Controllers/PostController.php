<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data= Article::index();
        // $data=DB::table('articles')->get();
        // dd(['data'=>$data]);
        return view('admin.listposts',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datacategory=DB::table('categories')->get();


        return view('admin.addpost',['danhmuc'=>$datacategory]);

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

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'key_meta' => 'required|string|max:255',
            'key_title' => 'required|string|max:255',
            'key_content' => 'required|string|max:1000',
            'short_description' => 'required|string|max:500',
            'content' => 'required|string',
            'status' => 'required|integer|max:11',
            'author_id' => 'required|integer|exists:users,id',
            'category_id' => 'required|integer|exists:categories,id',

            'imgpost' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


            $imageName = 'imgpost'.time().'.'
                                .$request->name.'.'
                                .$request->imgpost->extension();
            $request->imgpost->storeAs('public/posts', $imageName);

            // Chuẩn bị dữ liệu để lưu
            $data = [
                'title' => $validatedData['title'],
                'keymeta' => $validatedData['key_meta'],
                'keytitle' => $validatedData['key_title'],
                'keycontent' => $validatedData['key_content'],
                'short_description' => $validatedData['short_description'],
                'content' => $validatedData['content'],
                'author_id' => $validatedData['author_id'],
                'category_id' => $validatedData['category_id'],
                'status' => $validatedData['status'],

                'image_url' => 'storage/posts/' . $imageName,
                'views' => $request->input('views', 0),
                'created_at' => now(),
                'updated_at' => now(),
            ];


            $checkoke = Article::store($data);


            if ($checkoke) {
                return redirect()->back()->with('alert', [
                    'type' => 'success',
                    'message' => 'Bài viết đã được thêm thành công!'
                ]);
            } else {
                return redirect()->back()->with('alert', [
                    'type' => 'error',
                    'message' => 'Bài viết không được thêm thành công.'
                ]);
            }
        } catch (\Throwable $th) {

            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Có lỗi xảy ra khi tải lên ảnh: ' . $th->getMessage()
            ]);

            // dd($th);
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
        $upviews=DB::table('articles')->where('id', $id)->increment('views', 1);
        $query2=Comment::sumcmt($id);
        $query1=Comment::getcomment($id);
        $query=Article::getPostById($id);
        return view('detailArticle',['dulieu'=>$query,'dataus'=>$query1,'sum'=>$query2]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data_category=DB::table('categories')->get();
        $query=Article::showid($id);
        return view('admin.detailpost',['data'=>$query,'danhmuc'=>$data_category]);

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

    // $post=DB::table('articles')->get();
        try{
            // Xác thực dữ liệu từ request
    $validatedData = $request->validate([

        'title' => 'required|string|max:255',
        'key_meta' => 'required|string|max:255',
        'key_title' => 'required|string|max:255',
        'key_content' => 'required|string|max:1000',
        'short_description' => 'required|string|max:500',
        'content' => 'required|string',
        'status' => 'required|integer',
        'author_id' => 'required|integer|exists:users,id',
        'category_id' => 'required|integer|exists:categories,id',

        'imgpost' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);


    $article=DB::table('articles')->where('id', $id)->first();

    // Chuẩn bị dữ liệu để cập nhật
    $data = [

        'title' => $validatedData['title'],
        'keymeta' => $validatedData['key_meta'],
        'keytitle' => $validatedData['key_title'],
        'keycontent' => $validatedData['key_content'],
        'short_description' => $validatedData['short_description'],
        'content' => $validatedData['content'],
        'status' => $validatedData['status'],
        'author_id' => $validatedData['author_id'],
        'category_id' => $validatedData['category_id'],


    ];


    $data['image_url'] = $article->image_url;


    if ($request->hasFile('imgpost')) {


        if (file_exists(public_path($article->image_url))) {
            unlink(public_path($article->image_url));

        }
        $imageName = 'imgpost'.time().'_'
                                .$request->name.'.'
                                .$request->imgpost->extension();
        $request->file('imgpost')->storeAs('public/posts', $imageName);
        $data['image_url'] = 'storage/posts/' . $imageName;

    }else{
        $data['image_url'] = $article->image_url;
    }

    // dd($data);

    $updateResult = Article::updatepost($id,$data);



    if ($updateResult) {
        return redirect()->back()->with('alert', [
            'type' => 'success',
            'message' => 'Bài viết đã được chỉnh thành công!'
        ]);
    } else {
        return redirect()->back()->with('alert', [
            'type' => 'error',
            'message' => ' Bạn không thay đổi gì .'
        ]);
    }
} catch (\Throwable $th) {

    return redirect()->back()->with('alert', [
        'type' => 'error',
        'message' => 'Có lỗi xảy ra khi tải lên ảnh: ' . $th->getMessage()
    ]);

    // dd($th);
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
            $article = Article::find($id);
            if ($article) {
                // Xóa bài viết
                $article->delete();
                if (file_exists(public_path($article->image_url))) {
                    unlink(public_path($article->image_url));
                }

                // Thông báo thành công
                return redirect()->back()->with('alert',[
                        'type'=>'success',
                        'message'=>'Xóa bài viết thành công !'
                ]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('alert',[
                'type'=>'error',
                'message'=>' Lỗi : '.$th->getMessage()
        ]);
        }



    }
}

<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(15);
        $categories = Category::all();
        return view('admin.posts.index', compact('posts', 'categories'));
    }
    public function all_posts()
    {
        $posts = Post::paginate(15);
        $categories = Category::all();
        return view('posts.posts', compact('posts', 'categories'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|max:250',
            'content'=>'required|max:3000',
            'category_id'=>'required|numeric',
            'file'=>'nullable|file|image|max:1024',
            'is_approved'=>'nullable|numeric|max:2'
        ]);

        $user = Auth::user();
        $input = $request->all();
        $input['is_approved'] = 1;
        $post = $user->posts()->create($input);
        if($photo = $request->file('file')) {
            $path = $photo->storeAs('post_media', 'post_id_' . $post->id . "." . $photo->getClientOriginalExtension(), 'public');
            $post->medias()->create(['file'=>$path, 'is_approved'=>1]);
        }
        Session::flash('msg', "Post has been created");
        return redirect('/admin/posts');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::where('slug', $id)->first();
        return view('admin.posts.show', compact('post'));
//        return $post;
    }

    public function post($id)
    {
        $post = Post::where('slug', $id)->first();
        return view('admin.posts.show', compact('post'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
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
        return "UPDATING....";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



}

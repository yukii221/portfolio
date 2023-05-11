<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            $posts = Post::where('title', 'like', "%$cond_title%")->get();
        } else {
            $posts = Post::all();
        }

        return view('posts.index', compact('posts', 'cond_title'));}
    }
    
    public function add()
    {
        return view('posts.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       $this->validate($request, Post::$rules);

        $post = new Post;
        $form = $request->all();

        // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $post->image_url = basename($path);
        } else {
            $post->image_url = null;
        }
        
        $post->user_id = Auth::id(); 

        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        unset($form['image']);

        // データベースに保存する
        $post->fill($form);
        $post->save();
        
        return redirect()->route('posts.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        $user_id = $post->user_id;
        $user = DB::table('users')->where('id',$user_id)->first();
        
      return view('posts.detail',['post' => $post,'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //$post = Post::findOrFail($id);
        $post = Post::find($request->id);
        if (empty($post)) {
            abort(404);
        }
        
      return view('posts.edit',['post_form' => $post]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //$post = Post::findOrFail($id);
       // $post->body = $request->body;
        //$post->save();
        
         // Validationをかける
        $this->validate($request, Post::$rules);
        // Post Modelからデータを取得する
        $post = Post::find($request->id);
        // 送信されてきたフォームデータを格納する
        $post_form = $request->all();

        if ($request->remove == 'true') {
            $post_form['image_url'] = null;
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $post_form['image_url'] = basename($path);
        } else {
            $post_form['image_url'] = $post->image_path;
        }

        unset($post_form['image']);
        unset($post_form['remove']);
        unset($post_form['_token']);

        // 該当するデータを上書きして保存する
        $post->fill($post_form)->save();
        
      return redirect()->to('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // 該当するNews Modelを取得
        $post = Post::find($request->id);
        
        // 削除する
        if ($post) {
            $post->delete();
        
     
      return redirect()->to('/posts');
    }
}}
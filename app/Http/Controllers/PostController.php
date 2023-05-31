<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\Comment;
use App\Models\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            $posts = Post::where('title', 'like', "%$cond_title%")->get();
        } elseif ($request->category_id != '') {
            $posts = Post::where('category_id', $request->category_id)->get();
        } else {
            $posts = Post::all();
        }
        $categories = Category::all();

        return view('posts.index', compact('posts', 'cond_title','categories','request'));
    }
    
    public function add()
    {
        $categories = Category::all(); 
        return view('posts.create', compact('categories'));
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
    
        // フォームから画像が送信されてきたら、保存して、画像のパスを保存する
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
        $category_id = $request->input('category_id');
        $post->category_id = $category_id;
        $post->save();
    
        // $category = Category::find();
        // if ($category) {
        //     // カテゴリとの関連付け
        //     $post->category()->associate($category);
        //     $post->save();
        // }
        
        return redirect()->to('/posts');
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
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //$post = Post::find($request->id);
        //if (empty($post)) {
           // abort(404);
        //}
      //return view('posts.edit',['post_form' => $post]);
        $post = Post::find($request->id);
        if (empty($post) || (!Auth::user()->isAdmin() && Auth::user()->id !== $post->user_id)) {
            abort(404);
        }
        
        $categories = Category::all();
        
        return view('posts.edit', ['post_form' => $post, 'categories' => $categories]);
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
         // Validationをかける
        $this->validate($request, Post::$rules);
        // Post Modelからデータを取得する
        $post = Post::find($request->id);
        // 送信されてきたフォームデータを格納する
        $form = $request->all();

        if ($request->remove == 'true') {
            $form['image_url'] = null;
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $form['image_url'] = basename($path);
        } else {
            $form['image_url'] = $post->image_path;
        }

        unset($form['image']);
        unset($form['remove']);
        unset($form['_token']);

        // 該当するデータを上書きして保存する
        $post->fill($form);
        $category_id = $request->input('category_id');
        $post->category_id = $category_id;
        $post->save();
        
        if (empty($post) || (!Auth::user()->isAdmin() && Auth::user()->id !== $post->user_id)) 
        {
        abort(404);
         }
        
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
        $post = Post::find($request->id);
        if (empty($post) || (!Auth::user()->isAdmin() && Auth::user()->id !== $post->user_id)) {
            abort(404);
        }
        // 削除する
        $post->comments()->delete();
        if ($post) {
            $post->delete();
        }
      return redirect()->to('/posts');
    }
    
    public function commentCreate(Request $request, $post)
    {
        return view('posts.commentCreate', ['post' => $post]);
    }
}
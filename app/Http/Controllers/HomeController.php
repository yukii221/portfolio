<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
         $cond_title = $request->cond_title;
        if ($cond_title != '') {
            $posts = Post::where('title', 'like', "%$cond_title%")->get();
        } else {
            $posts = Post::all()->sortByDesc('updated_at');
        }
        return view('home', ['cond_title' => $cond_title, 'posts' => $posts]);
    }
}

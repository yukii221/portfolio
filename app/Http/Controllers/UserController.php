<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller
{
     public function index(Request $request)
{
    $cond_name = $request->cond_name;
    if ($cond_name != '') {
        $users = User::where('name', "%$cond_name%")->get();
    } else {
        $users = User::all();
    }

    return view('users.index', compact('users', 'cond_name'));
}

    //public function create()
    //{
        //return view('users.create');
    //}

    // public function store(Request $request)
    // {
    //     //dd(__LINE__);
    //     $user = new User();
    //     $user->name = $request->input('name');
    //     $user->email = $request->input('email');
    //     $user->password = bcrypt($request->input('password'));
    //     //$user->age = $request->input('age');
    //     $user->profile = $request->input('profile');
    //     $user->save();

    //     return redirect()->route('users.index');
    // }

    // public function show($id)
    // {
    //     $user = User::find($id);
    //     return view('users.show', compact('user'));
    // }

    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request,$id)
    {
         // Validationをかける
        $this->validate($request, User::$rules);
        // Post Modelからデータを取得する
        $user = User::find($id);
        
        // データが見つからない場合は直前のページに戻る
        if (!$user) {
        return back()->with('error', 'データが見つかりませんでした。');
        }

        // 送信されてきたフォームデータを格納する
        $user_form = $request->all();
        unset($user_form['_token']);
        // 該当するデータを上書きして保存する
        $user->fill($user_form)->save();

        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index');
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}

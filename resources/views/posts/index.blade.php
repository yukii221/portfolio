@extends('layouts.front')
@section('title', '投稿一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2 class="text-title">投稿一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('posts.add') }}" role="button" class="btn btn-outline-success">新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ route('posts.index') }}" method="get">
                    <div class="form-group row justify-content-end">
                        <div class="col-md-8">
                            <select name="category_id" class="form-control">
                                <option value="">カテゴリー絞込</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        @if ($category->id == $request->category_id)
                                            selected
                                        @endif
                                    >{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="submit" class="btn btn-outline-success" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                    <table class="table table-light">
                        <thead>
                            <tr>
                                <th width="15%">カテゴリー</th>
                                <th width="25%">タイトル</th>
                                <th width="50%">本文</th>
                                <th width="10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <!--<th>{{ $post->id }}</th>-->
                                    <td>
                                        @if ($post->category !== null)
                                        {{ $post->category->name }}
                                        @endif
                                    </td>
                                    <td>{{ Str::limit($post->title, 100) }}</td>
                                    <td>{{ Str::limit($post->content, 250) }}</td>
                                    <td>
                                        <div>
                                            @if (Auth::check() && (Auth::user()->isAdmin() || Auth::user()->id === $post->user_id))
                                                <a href="{{ route('posts.edit', ['id' => $post->id]) }}" class="btn btn-outline-success">編集</a>
                                            @endif
                                        </div>
                                        <div>
                                            @if (Auth::check() && (Auth::user()->isAdmin() || Auth::user()->id === $post->user_id))
                                                <form onsubmit="return confirm('本当に削除しますか？')" action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-success">削除</button>
                                                </form>
                                            @endif
                                        </div>    
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

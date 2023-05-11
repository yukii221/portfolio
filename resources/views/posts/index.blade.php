@extends('layouts.app')
@section('title', '内容')

@section('content')
    <div class="container">
        <div class="row">
            <h2>投稿一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('posts.add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ route('posts.index') }}" method="post">
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                        </div>
                        <div class="col-md-2">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">タイトル</th>
                                <th width="40%">本文</th>
                                <th width="30%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <th>{{ $post->id }}</th>
                                    <td>{{ Str::limit($post->title, 100) }}</td>
                                    <td>{{ Str::limit($post->content, 250) }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ route('posts.edit', ['id' => $post->id]) }}">編集</a>
                                        </div>
                                        <div>
                                            <form action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">削除</button>
                                            </form>
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

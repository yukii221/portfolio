@extends('layouts.app')
@section('title', '投稿詳細')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>投稿詳細</h2>
                 <table class="table table-dark">
                    <thead>
                        <tr>
                            <th width="10%">ID</th>
                            <th width="30%">タイトル</th>
                            <th width="60%">本文</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>{{ $post->id }}</th>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->content }}</td>
                        </tr>
                        <div>
                            <a class="btn btn-primary" href="{{ route('comments.index',['id' => $post->id]) }}">コメント一覧を表示</a>
                            <a class="btn btn-primary" href="{{ route('posts.commentCreate',['post' => $post->id]) }}">コメントする</a>
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
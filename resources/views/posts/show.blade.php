@extends('layouts.front')
@section('title', '投稿詳細')

@section('content')
    <div class="container">
        <div class="row">
            <h2>投稿詳細</h2>
        </div>
        <div class="row">
            <div class="col-md-12 mx-auto">
                <table class="table table-light">
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
                            <a class="btn btn-outline-success" href="{{ route('posts.commentCreate',['post' => $post->id]) }}">コメントする</a>
                        </div>
                    </tbody>
                </table>
                <div class="row">
                    <h3>コメント一覧</h3>
                </div>
                <table class="table table-light">
                    <tbody>
                        @foreach($post->comments as $comment)
                            <tr>
                                <td>{{ $comment->content }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.front')
@section('title', '投稿詳細')

@section('content')
    <div class="container">
        <div class="card-contents">
            <h2 class="text-title">投稿詳細</h2>
            <hr color="#c0c0c0">
            <div class="row">
                <div class="posts col-md-8 mx-auto mt-3">
                    <div class="post">
                        <div>{{ $post->title }}</div>
                        <div>{!! nl2br(e($post->content)) !!}</div>
                        <div>
                            <a class="btn btn-outline-success" href="{{ route('posts.commentCreate',['post' => $post->id]) }}">コメントする</a>
                        </div>
                    </div>
                    <hr color="#c0c0c0">
                </div>
            </div>
        <div class="posts col-md-8 mx-auto mt-3">
        <h3 class="text-title">コメント</h3>
        <hr color="#c0c0c0">
            <div class="row">
                @foreach($post->comments as $comment)
                    <div>{{ $comment->content }}</div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
        
        <!--<div class="row">-->
        <!--    <div class="col-md-12 mx-auto">-->
        <!--        <table class="table table-light">-->
        <!--            <thead>-->
        <!--                <tr>-->
        <!--                    <th width="10%">ID</th>-->
        <!--                    <th width="30%">タイトル</th>-->
        <!--                    <th width="60%">本文</th>-->
        <!--                </tr>-->
        <!--            </thead>-->
        <!--            <tbody>-->
        <!--                <tr>-->
        <!--                    <th>{{ $post->id }}</th>-->
        <!--                    <td>{{ $post->title }}</td>-->
        <!--                    <td>{!! nl2br(e($post->content)) !!}</td>-->
        <!--                </tr>-->
        <!--                <div>-->
        <!--                    <a class="btn btn-outline-success" href="{{ route('posts.commentCreate',['post' => $post->id]) }}">コメントする</a>-->
        <!--                </div>-->
        <!--            </tbody>-->
        <!--        </table>-->
        <!--        <div class="row">-->
        <!--            <h3>コメント一覧</h3>-->
        <!--        </div>-->
        <!--        <table class="table table-light">-->
        <!--            <tbody>-->
        <!--                @foreach($post->comments as $comment)-->
        <!--                    <tr>-->
        <!--                        <td>{{ $comment->content }}</td>-->
        <!--                    </tr>-->
        <!--                @endforeach-->
        <!--            </tbody>-->
        <!--        </table>-->
           
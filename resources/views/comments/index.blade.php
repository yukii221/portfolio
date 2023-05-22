@extends('layouts.app')
@section('title', 'コメント一覧')

@section('content')
    <div class="container">
        <h2>コメント一覧</h2>
        <ul>
            @foreach($comments as $comment)
                <li>{{ $comment->content }}</li>
            @endforeach
        </ul>
    </div>
@endsection
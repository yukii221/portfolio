@extends('layouts.front')
@section('title', 'ポートフォリオ')

@section('content')
<div class="container">
    <div class="row">
        <div>
            <span>カテゴリー</span>
            @foreach($categories as $category)
                <a class="btn btn-outline-success custom-button btn-sm" href="/home?category_id={{ $category->id }}">{{ $category->name }}</a>
            @endforeach
        </div>
    </div>
    <div class="card-contents">
        <h2 class="text-title">投稿一覧</h2>
        <hr color="#c0c0c0">
        <div class="row">
            <div class="posts col-md-8 mx-auto mt-3">
                @foreach($posts as $post)
                    <div class="post">
                            <div class="date">
                                {{ $post->updated_at->format('Y年m月d日') }}
                            </div>
                            <div class="title">
                                {{ Str::limit($post->title, 150) }}
                            </div>
                            <div class="body mt-3">
                                {{ Str::limit($post->content, 1500) }}
                            </div>
                            @if ($post->image_url)
                                <div class="image col-md-6 text-right mt-4">
                                <img src="{{ secure_asset('storage/image/' . $post->image_url) }}">
                                </div>
                            @endif
                        <div>
                             <a class="btn btn-outline-success" href="{{ route('posts.show', ['id' => $post->id]) }}">詳細</a>
                        </div>
                    </div>
                    <hr color="#c0c0c0">
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

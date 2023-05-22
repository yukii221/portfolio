@extends('layouts.front')
@section('title', 'ポートフォリオ')

@section('content')
<div class="container">
    <div class="card-contents">
        <h2 class="text-title">投稿一覧</h2>
        <hr color="#c0c0c0">
        <div class="row">
            <div class="posts col-md-8 mx-auto mt-3">
                @foreach($posts as $post)
                    <div class="post">
                        <div class="row">
                            <div class="text col-md-6">
                                <div class="date">
                                    {{ $post->updated_at->format('Y年m月d日') }}
                                </div>
                                <div class="title">
                                    {{ Str::limit($post->title, 150) }}
                                </div>
                                <div class="body mt-3">
                                    {{ Str::limit($post->content, 1500) }}
                                </div>
                            </div>
                            <div class="image col-md-6 text-right mt-4">
                                @if ($post->image_url)
                                    <img src="{{ secure_asset('storage/image/' . $post->image_url) }}">
                                @endif
                            </div>
                            <div>
                                 <a class="btn btn-primary" href="{{ route('posts.show', ['id' => $post->id]) }}">詳細</a>
                            </div>
                        </div>
                    </div>
                    <hr color="#c0c0c0">
                @endforeach
            </div>
        </div>
    </div>
    <!--<div class="card-contents">-->
    <!--    <h2 class="text-title">カテゴリー</h2>-->
    <!--</div>-->
</div>
@endsection

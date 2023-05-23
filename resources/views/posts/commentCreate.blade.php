@extends('layouts.front')
@section('title', 'コメント入力')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>コメント入力</h2>
                <form action="{{ route('comments.create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group">
                        <label for="body">本文</label>
                        <textarea id="comment"name="content"class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}"rows="4">{{ old('content') }}</textarea>
                        @if ($errors->has('content'))
                             <div class="invalid-feedback">
                             {{ $errors->first('content') }}
                         </div>
                        @endif
                    </div>
                    <input type="hidden" value="{{ $post }}" name="post_id">
                    @csrf
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')
@section('title', '一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('users.create') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ route('users.index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">名前</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_name" value="{{ $cond_name }}">
                        </div>
                        <div class="col-md-2">
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
                                <th width="20%">名前</th>
                                <th width="20%">メールアドレス</th>
                                <th width="30%">プロフィール</th>
                                <th width="20%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th>{{ $user->id }}</th>
                                    <td>{{ Str::limit($user->name, 100) }}</td>
                                    <td>{{ Str::limit($user->email, 100) }}</td>
                                    <td>{{ Str::limit($user->name, 100) }}</td>
                                    <td>{{ Str::limit($user->profile, 250) }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ route('users.edit', ['user' => $user->id]) }}">編集</a>
                                        </div>
                                        <div>
                                            <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST">
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


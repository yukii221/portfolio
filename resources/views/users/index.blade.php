@extends('layouts.front')
@section('title', 'ユーザー一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2 class="text-title">ユーザー一覧</h2>
        </div>
        <div>
            <div>
                <form action="{{ route('users.index') }}" method="get">
                    <div class="form-group row justify-content-end">
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="cond_name" value="{{ $cond_name }}">
                        </div>
                        <div class="col-md-1">
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
                            <th width="20%">名前</th>
                            <th width="20%">メールアドレス</th>
                            <th width="50%">プロフィール</th>
                            <th width="10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ Str::limit($user->name, 100) }}</td>
                                <td>{{ Str::limit($user->email, 100) }}</td>
                                <td>{{ Str::limit($user->profile, 250) }}</td>
                                <td>
                                    <div>
                                        @if (Auth::user()->isAdmin() || Auth::user()->id === $user->id)
                                            <button type="submit" class="btn btn-outline-success" href="{{ route('users.edit', ['user' => $user->id]) }}">編集</button>
                                        @endif
                                    </div>
                                    <div>
                                        @if (Auth::user()->isAdmin() || Auth::user()->id === $user->id)
                                            <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-success" >削除</button>
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
@endsection


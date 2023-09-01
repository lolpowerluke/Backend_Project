@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card questions">
                <div class="card-header admin-users">
                    <form class="form-inline" method="GET" action="{{ route('admin.searchNews') }}">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                    </form>
                    <button class="btn btn-primary">Search</button>
                    <button class="btn btn-primary">Create New User</button>
                </div>
                <div class="card-body userList">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach($news as $news)
                    <div class="card">
                        <div class="card-body">{{ $news->title }}</div>
                        <div class="card-body">ID: {{ $news->id }}</div>
                        <form method="POST" action="{{ route('news.destroy', $news->id) }}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="DELETE NEWS" onclick="return confirm('Are you sure you want to delete this news item');">
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card questions">
                <div class="card-header admin-users">
                    <form class="form-inline" method="GET" action="{{ route('admin.searchToAddToFAQ') }}">
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
                    @foreach($questions as $question)
                    <div class="card">
                        <div class="card-body">{{ $question->title }}</div>
                        <div class="card-body">ID: {{ $question->id }}</div>
                        <form method="POST" action="{{ route('admin.addToFAQ', $question->id) }}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="ADD TO FAQ" onclick="return confirm('Are you sure you want to add this question to the FAQ page?');">
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


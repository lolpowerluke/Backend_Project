@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card questions">
                <div class="card-header admin-users">
                    <form class="form-inline" method="GET" action="{{ route('admin.userSearch') }}">
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
                    @foreach($users as $user)
                    <div class="card">
                        <div class="card-body">{{ $user->name }}</div>
                        <div class="card-body">ID: {{ $user->id }}</div>
                        <button class="btn btn-danger hidden" onclick="window.location.href='{{ route('admin.makeUserAdmin', $user->id) }}'">Make Admin</button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


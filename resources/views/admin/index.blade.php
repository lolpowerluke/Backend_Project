@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card questions">
                <div class="card-header">Admin Page</div>
                <div class="card-body adminTileList">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card" onclick="window.location.href='/admin/users';">
                        <div class="card-body">
                            <span class="card-title">Users</span>
                        </div>
                    </div>
                    <div class="card" onclick="window.location.href='/admin/news';">
                        <div class="card-body">
                            <span class="card-title">News</span>
                        </div>
                    </div>
                    <div class="card" onclick="window.location.href='/admin/questions';">
                        <div class="card-body">
                            <span class="card-title">Questions</span>
                        </div>
                    </div>
                    <div class="card" onclick="window.location.href='/admin/categories';">
                        <div class="card-body">
                            <span class="card-title">Categories</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


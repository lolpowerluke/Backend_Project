@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card questions">
                <div class="card-header">Admin Page</div>
                <div class="card-body questionsList">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card" onclick="window.location.href='/admin/userSearch';">
                        <div class="card-body">
                            <span class="card-title">Add Admins</span>
                        </div>
                    </div>
                    <div class="card" onclick="window.location.href='/admin/searchUserToDelete';">
                        <div class="card-body">
                            <span class="card-title">Remove Users</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


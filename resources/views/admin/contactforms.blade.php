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
                    @foreach($contactforms as $contactform)
                    <div class="card" onclick="window.location.href='/contactform/{{ $contactform->id }}';">
                        <div class="card-body">
                            <span class="card-title">{{ $contactform->title }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card about">
                <div class="card-header">About</div>
                
                <div class="card-body">
                    @foreach ($about as $about)
                        <a href="{{ $about->link }}">{{ $about->resource }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


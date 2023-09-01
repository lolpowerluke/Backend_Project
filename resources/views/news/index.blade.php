@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('All the news') }}
                    <form class="form-inline" method="GET" action="{{ route('news.index') }}">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                    </form>
                    @auth
                    <a class="navbar-brand" href="{{ route('news.create') }}">New Article</a>
                    @endauth
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card-body-inner">
                        @foreach($news as $news)
                        <div class="card" onclick="window.location.href='/news/{{ $news->id }}';">
                            <img class="card-img" src="{{ asset('images/'.$news->image_name) }}" alt="{{ $news->title }}">
                            <div class="card-body">
                                <span class="card-title">{{ $news->title }} </span>
                                <span>{{ $news->short_desc }}</span>
                                <small>Gepost door <a href="{{ route('user.show', $news->user->id) }}"> {{ $news->user->name }}</a> op {{ $news->created_at->format('d/m/y \o\m H:i') }}</small>
                                <small>{{ $news->likes->count() }} likes</small>
                                @auth
                                @if($news->user_id == Auth::id())
                                    <div class="card-buttons">
                                    <a href="{{ route('news.edit', $news->id)}}" class="btn btn-primary">Edit</a>
                                    </div>
                                @else
                                    @if($news->likes->where('user_id', Auth::id())->count() == 0)
                                    <div class="card-buttons">
                                        <a href="{{ route('like', $news->id)}}" class="btn btn-primary">Like</a>
                                    </div>
                                    @endif
                                @endif
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


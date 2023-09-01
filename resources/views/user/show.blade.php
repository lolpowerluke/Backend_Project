@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 profile-view">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card profile">
                <div class="card-header">Profiel van {{ $user->name }}</div>
                
                <div class="card-body">
                    @if($user->image_name)
                        <img src="{{ asset('images/' . $user->image_name) }}" class="profile-image">
                    @else
                        <img src="{{ asset('images/default.jpg') }}" class="profile-image">
                    @endif
                    <div class="timestamp">
                        <div>
                            <span class="next-is-hidden">Joined {{ $user->created_at->format('d-m-Y') }}</span>
                            <span class="hidden-until-hover-previous">{{ $user->created_at->diffForHumans() }}</span>
                        </div>
                        <div>
                            @if($user->birthday)
                                <span class="next-is-hidden">Born on {{ $user->birthday }}</span>
                                <span class="hidden-until-hover-previous">{{ $age }}</span>
                            @endif
                        </div>
                    </div>
                    <span class="card-text">Abour me: {{ $user->bio }}</span>

                    @auth
                    @if(Auth::user()->id == $user->id)
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                    @endif
                    @endauth
                </div>
            </div>
            <div class="card profile">
                <div class="card-header">Made Posts</div>

                <div class="card-body">
                    @foreach($user->news as $news)
                        <div class="card mb-3">
                            <div class="card-header">
                                <a href="{{ route('news.show', $news->id) }}">{{ $news->title }}</a>
                            </div>
                            <div class="card-body">
                                <p>{{ $news->body }}</p>
                                <p class="card-text"><small class="text-muted">Posted by {{ $news->user->name }} on {{ $news->created_at }}</small></p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card profile">
                <div class="card-header">Liked Posts</div>

                <div class="card-body">
                    @foreach($user->likes as $like)
                        <div class="card mb-3">
                            <div class="card-header">
                                <a href="{{ route('news.show', $like->news->id) }}">{{ $like->news->title }}</a>
                            </div>
                            <div class="card-body">
                                <p>{{ $like->news->body }}</p>
                                <p class="card-text"><small class="text-muted">Posted by {{ $like->news->user->name }} on {{ $like->news->created_at }}</small></p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __($news->title) }}</div>
            <img class="card-img" src="{{ asset('images/'.$news->image_name) }}" alt="{{ $news->title }}">
            <div class="card-body">
                <span class="card-title">{{ $news->title }} </span>
                <span>{{ $news->short_desc }}</span>
                <span>{{ $news->content }}</span>
                <small>Gepost door {{ $news->user->name }} op {{ $news->created_at->format('d/m/y \o\m H:i') }}</small>
                <small>{{ $news->likes->count() }} likes</small>
                @auth
                @if(Auth::user()->admin || $news->user_id == Auth::id())
                <div class="card-buttons">
                    <a href="{{ route('news.edit', $news->id)}}" class="btn btn-primary">Edit</a>
                    <form action="/news/{{ $news->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger" value="DELETE POST" onclick="return confirm('Are you sure you want to delete this post');">
                    </form>
                @elseif($news->user_id == Auth::id())
                    <div class="card-buttons">
                        <a href="{{ route('news.edit', $news->id)}}" class="btn btn-primary">Edit</a>
                    </div>
                @elseif($news->likes->where('user_id', Auth::id())->count() == 0)
                    <div class="card-buttons">
                        <a href="{{ route('like', $news->id)}}" class="btn btn-primary">Like</a>
                    </div>
                @endif
                @endauth
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


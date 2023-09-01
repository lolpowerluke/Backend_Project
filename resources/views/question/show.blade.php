@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 question">
            <div class="card faq">
                <div class="card-header">{{ $question->title }}</div>
                
                <div class="card-body">
                    <div class="question">
                        <p>{{ $question->content }}</p>
                    </div>
                </div>
            </div>
            <div class="card comments">
                <div class="card-header">Comments</div>
                <div class="card-body">
                    @foreach($question->comments as $comment)
                        <div class="comment">
                            <div class="comment-header">
                                <div class="profile-image">
                                @if($comment->user->image_name)
                                    <img src="{{ asset('images/' . $comment->user->image_name) }}" class="profile-image">
                                @else
                                    <img src="{{ asset('images/default.jpg') }}" class="profile-image">
                                @endif
                                </div>
                                <span>{{ $comment->user->name }}</span>
                                <span class="comment-header-seperator">  |  </span>
                                <span>{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <span class="content">{{ $comment->content }}</span>
                            @auth
                            @if($comment->user_id == Auth::id())
                            <div class="comment-footer">
                                <button class="btn btn-primary" class="edit-comment-button" id="edit-comment-button" onclick="showEditCommentForm()">Edit</button>
                                <form action="{{ route('comment.update', $comment->id) }}" id="edit-comment-form" style="display:none;">
                                    @csrf
                                    @method('PUT')
                                    <div class="input-group mb-3">
                                        <input type="hidden" name="question_id" value="{{ $question->id }}">
                                        <textarea class="form-control" name="content" rows="3">{{ $comment->content }}</textarea>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="cancel" class="btn btn-danger" onclick="hideEditCommentForm()">Cancel</button>
                                    </div>
                                </form>
                                <form id="delete-comment-button" method="POST" action="{{ route('comment.destroy', $comment->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                            @endif
                            @endauth
                        </div>
                    @endforeach
                    @auth
                    <button id="comment-button" onclick="showCommentForm()" class="btn btn-primary">Add Comment</button>
                    <div id="comment-form" style="display: none;">
                        <form method="POST" action="{{ route('comment.store') }}">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="hidden" name="question_id" value="{{ $question->id }}">
                                <textarea class="form-control" name="content" rows="3"></textarea>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


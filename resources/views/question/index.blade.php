@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card questions">
            <div class="card-header">All Questions
                @auth
                <a class="navbar-brand" href="{{ route('question.create') }}">New Question</a>
                @endauth
            </div>
                <div class="card-body questionsList">
                    <span class="hidden">{{ $count = 0; }}</span>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach($categories as $categorie)
                        <h2>{{ $categorie->name }}</h2>
                        <div class="accordion" id="accordionExample">
                            @foreach($categorie->questions as $question)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $count }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $count }}" aria-expanded="false" aria-controls="collapse{{ $count }}">
                                            {{ $question->title }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $count }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $count }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div>{{ $question->content }}</div>
                                            <a href="{{ route('question.show', $question->id) }}" class="btn btn-primary">Read More</a>
                                        </div>
                                    </div>
                                </div>
                                <span class="hidden">{{ $count++ }}</span>
                            @endforeach
                        </div>
                    @endforeach
                    <h2>No Category</h2>
                    <div class="accordion" id="accordionExample">
                    @foreach($questions as $question)
                        @if($question->categorie_id == null)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $count }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $count }}" aria-expanded="false" aria-controls="collapse{{ $count }}">
                                        {{ $question->title }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $count }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $count }}" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div>{{ $question->content }}</div>
                                        <a href="{{ route('question.show', $question->id) }}" class="btn btn-primary">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <span class="hidden">{{ $count++ }}</span>
                        @endif
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card faq">
                <div class="card-header">Frequently Asked Questions</div>
                
                <div class="card-body faq">
                    <span class="hidden">{{ $count = 0; }}</span>
                    @foreach($categories as $categorie)
                        <h2>{{ $categorie->name }}</h2>
                        <div class="accordion" id="accordionExample">
                            @foreach($categorie->questions as $question)
                                @if($question->is_faq)
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
@endsection


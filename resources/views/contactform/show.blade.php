@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card contactform">
        <div class="card-header">{{ __($contactform->title) }}</div>
            <div class="card-body">
                <span class="card-title">{{ $contactform->title }} </span>
                <span>{{ $contactform->content }}</span>
                <span>Posted by: {{ $contactform->email }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


<?php
/**
 * @var \App\Models\Question $question
 * @var \App\Services\TranslatorService $t
 */
?>

@extends('layouts.myapp')

@section('page_title', __('site.poll.vote'))

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                  @if(Session::has('success'))
            <div class="alert alert-success mt-3" id="successMessage">
                {{ Session::get('success') }}
            </div>
        @endif

        @if(Session::has('warning'))
            <div class="alert alert-warning mt-3">
                {{ Session::get('warning') }}
            </div>
        @endif

        @if(Session::has('error'))
            <div class="alert alert-danger mt-3">
                {{ Session::get('error') }}
            </div>
        @endif
                <div class="card" style="background-color: #e8e7e7">
                    <div class="card-header bg-dark text-white">
                        <h1 class="text-center mb-0">{{$t->translate($question->title, app()->getLocale())}}</h1>
                    </div>
                    <div class="card-body">
                        @if($question->image)
                            <img src="{{ asset('storage/uploads/' . $question->image->filename) }}"  style="height: 300px;" alt="Question Image" class="img-fluid mb-3 question-image">
                        @endif

                        <p class="mb-3"  style="font-size: 30px;">{{$t->translate($question->description, app()->getLocale())}}</p>

                        <p><strong>{{__('site.question.field.start_at')}}:</strong> {{ $question->start_at ? $question->start_at->format('Y-m-d H:i') : 'Not specified' }}</p>
                        <p><strong>{{__('site.question.field.end_at')}}:</strong> {{ $question->end_at ? $question->end_at->format('Y-m-d H:i') : 'Not specified' }}</p>

                        <p><strong>{{__('site.question.created_by')}}:</strong> {{ $question->user->email }}</p>

                        @auth
                         @php
                            $userVote = $question->getUserVote(Auth::user());
                        @endphp
                            <form action="{{ route('poll.vote', $question) }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <strong>{{__('site.poll.select_option')}}:</strong>
                                    <div class="row mt-3">
                                        @foreach($question->options as $option)
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="selected_option" value="{{ $option->id }}" id="option{{ $option->id }}" {{ $userVote && $userVote->option_id == $option->id ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="option{{ $option->id }}">
                                                        @if($option->image)
                                                            <img src="{{ asset('storage/uploads/' . $option->image->filename) }}"  style="width: 300px; height: 200px;" alt="Option Image" class="img-thumbnail option-image">
                                                        @endif
                                                        {{$t->translate($option->title, app()->getLocale())}}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">{{__('site.poll.vote')}}</button>
                            </form>
                        @else
                            <p class="alert alert-secondary font-weight-bold text-danger">{{__('site.sentence.must_login')}} <a href="{{ route('login') }}" class="text-primary">Login</a></p>
                        @endauth

                        <h2 class="mt-4">{{__('site.poll.results')}}:</h2>
                        @if($question->totalVotes() > 0)
                            @foreach($question->options as $option)
                                <p>
                                    {{$t->translate($option->title, app()->getLocale())}}:
                                    {{ $question->percentageVotes($option) }}% ({{ $option->votesCount() }} {{__('site.poll.votes')}})
                                </p>
                                <div class="progress mb-3">
                                    <div class="progress-bar  progress-bar-striped bg-dark" role="progressbar" style="width: {{ $question->percentageVotes($option) }}%;" aria-valuenow="{{ $question->percentageVotes($option) }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            @endforeach
                        @else
                            <p>{{__('site.sentence.no_votes')}}</p>
                        @endif
                    </div>
                </div>

                <a href="{{ route('poll.index') }}" class="btn btn-secondary mt-3">{{__('site.poll.back_to_poll')}}</a>
            </div>
        </div>
    </div>

  

    <script>
        setTimeout(function() {
            document.getElementById('successMessage').style.display = 'none';
        }, 5000);
    </script>
@endsection

<?php
/**
 * @var \App\Models\Question[] $activeQuestions
 *  @var \App\Services\TranslatorService $t
 */
?>
@extends('layouts.myapp')

@section('page_title', __('site.poll.poll'))

@section('content')
    <div class="container">
        <h1 class="text-center mb-4 mt-2 text-light">{{__('site.question.active_questions')}}</h1>

        <div class="row justify-content-end">
        <div class="col-md-4 mb-3">
            <form action="{{ route('poll.index') }}" method="GET" id="searchForm">
                <div class="input-group">
                    <input type="text" name="query" class="form-control" placeholder="{{__('site.action.search')}}" value="{{ $query ?? '' }}" id="searchInput">
                    <button type="submit" class="btn btn-dark">{{__('site.action.search')}}</button>
                </div>
            </form>
        </div>
    </div>

        <div class="row">
            @forelse($activeQuestions as $question)
                <div class="col-md-4 mb-3">
                    <div class="card" style="text-decoration: none; color: inherit;">
                        <div class="card-body">
                            @if($question->image)
                                <img src="{{ asset('storage/uploads/' . $question->image->filename) }}" class="card-img-top" alt="Question Image" style="width: 100%; height: 150px; object-fit: cover;">
                             @else
                                <img src="{{ asset('images/no_image.jpg') }}" class="card-img-top" alt="No Image" style="width: 100%; height: 150px; object-fit: cover;">
                             @endif
                            <h5 class="card-title">{{$t->translate($question->title, app()->getLocale())}}</h5>
                            <p class="card-text">
                                <strong>{{__('site.question.field.start_at')}}:</strong> {{ $question->start_at->format('d.m.Y H:i') }}<br>
                                <strong>{{__('site.question.field.end_at')}}:</strong> {{ $question->end_at->format('d.m.Y H:i') }}
                            </p>
                            <a href="{{ route('poll.show', [$question]) }}" class="btn btn-dark">{{__('site.action.view_details')}}</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-light">{{__('site.sentence.no_questions')}}</p>
            @endforelse
        </div>
    </div>
@endsection




<?php
/**
 * @var \App\Models\Question[] $models
 * @var \App\Services\TranslatorService $t
 */
?>
@extends('layouts.myapp')

@section('page_title', __('site.question.my_questions'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="text-center mb-4">{{__('site.question.my_questions')}}</h1>
                <a href="{{ route('questions.create') }}" class="btn btn-primary mb-3">{{__('site.action.create')}}</a>

                @if($models)
                    @foreach($models as $question)
                        <a href="{{ route('questions.show', [$question]) }}" class="card mb-3 mx-auto" style="max-width: 600px; text-decoration: none; color: inherit;">
                            <div class="card-body">
                                @if($question->image)
                                    <img src="{{ asset('storage/uploads/' . $question->image->filename) }}" class="card-img-top" alt="Question Image" style="width: 100%; height: 150px; object-fit: cover;">
                                @endif
                                <h5 class="card-title mt-2">{{$t->translate($question->title, app()->getLocale())}}</h5>
                                <p class="card-text mb-2">
                                   {{$t->translate($question->description, app()->getLocale())}} <br><br>
                                    <strong > {{__('site.question.field.start_at')}}:</strong> {{ $question->start_at->format('d.m.Y H:i') }}<br>
                                    <strong> {{__('site.question.field.end_at')}}:</strong> {{ $question->end_at->format('d.m.Y H:i') }}<br>
                                    <strong>{{ $question->active ? __('site.question.field.active') : __('site.question.field.not_active') }} </strong>

                                </p>
                                <div>
                                    <a href="{{ route('questions.edit', [$question]) }}" class="btn btn-primary mr-2">{{__('site.action.edit')}}</a>
                                    <form action="{{ route('questions.destroy', $question) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">{{__('site.action.delete')}}</button>
                                    </form>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <p>No questions available.</p>
                @endif
            </div>
        </div>
    </div>
@endsection


@push('scripts')
@endpush

@push('styles')
@endpush

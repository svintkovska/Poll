<?php
/**
 * @var $question \App\Models\Question
 * @var \App\Services\TranslatorService $t
 */

?>
@extends('layouts.myapp')

@section('page_title', __('site.action.watch'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{$t->translate($question->title, app()->getLocale())}}</h5>
                        <div class="mb-3">
                            <label for="image" class="form-label"></label>
                            @if($question->image)
                                <img src="{{ asset('storage/uploads/' . $question->image->filename) }}" alt="Current Image" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                            @endif
                        </div>
                        <p class="card-text"><strong>{{__('site.question.field.description')}}:</strong> {{$t->translate($question->description, app()->getLocale())}}</p>
                        <p class="card-text"><strong>{{__('site.question.field.start_at')}}:</strong> {{ $question->start_at->format('d.m.Y H:i') }}</p>
                        <p class="card-text"><strong>{{__('site.question.field.end_at')}}:</strong> {{ $question->end_at->format('d.m.Y H:i') }}</p>
                        <strong>{{ $question->active ? __('site.question.field.active') : __('site.question.field.not_active') }} </strong>

                    </div>
                </div>

                <h2 class="text-center">{{__('site.option.plural')}}</h2>
                @foreach ($question->options as $option)
                    <div class="card mb-3">
                        <div class="card-body d-flex justify-content-start align-items-center">
                            <div>
                                @if ($option->image)
                                    <img src="{{ asset('storage/uploads/' . $option->image->filename) }}" alt="Option Image" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
                                @endif
                            </div>
                            <div class="ms-3">
                                <h5 class="card-title m-3">{{$t->translate($option->title, app()->getLocale())}}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach

                <a href="{{ route('questions.index') }}" class="btn btn-primary">{{__('site.action.back_to_questions')}}</a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush

@push('styles')

@endpush
<?php
/**
 * @var $model \App\Models\Question
 */
?>
@extends('layouts.myapp')

@section('page_title', __('site.action.edit_entity', ['entity' => __('site.question.single')]))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="text-center mb-4"> {{__('site.action.edit_entity', ['entity' => __('site.question.single')])}}</h1>
                     @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                   @endif
                <form method="post" action="{{ route('questions.update', [$model]) }}" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="title" class="form-label">{{__('site.question.field.title')}}</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $model->title }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="description" class="form-label">{{__('site.question.field.description')}}</label>
                            <input type="text" class="form-control" id="description" name="description" value="{{ $model->description }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start_at" class="form-label">{{__('site.question.field.start_at')}}</label>
                            <input type="datetime-local" class="form-control" id="start_at" name="start_at" value="{{ $model->start_at ? $model->start_at->format('Y-m-d\TH:i') : '' }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="end_at" class="form-label">{{__('site.question.field.end_at')}}</label>
                            <input type="datetime-local" class="form-control" id="end_at" name="end_at" value="{{ $model->end_at ? $model->end_at->format('Y-m-d\TH:i') : '' }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="active" class="form-label">{{__('site.question.field.active')}}</label>
                            <input type="checkbox" class="form-check-input ml-4" id="active" name="active" {{ $model->active ? 'checked' : '' }}>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label"> {{__('site.question.field.current_image')}}</label>
                        @if($model->image)
                            <img src="{{ asset('storage/uploads/' . $model->image->filename) }}" alt="Current Image" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                        @else
                           {{__('site.question.no_image')}}
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="new_image" class="form-label">{{__('site.question.field.new_image')}}</label>
                        <input type="file" class="form-control" id="new_image" name="new_image">
                    </div>

                    <h2>{{__('site.option.plural')}}</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{__('site.option.field.title')}}</th>
                                <th>{{__('site.question.field.current_image')}}</th>
                                <th>{{__('site.question.field.new_image')}}</th>
                                <th>{{__('site.action.delete')}}</th>
                            </tr>
                        </thead>
                        <tbody id="options-table-body">
                            @foreach ($model->options as $option)
                                <tr data-id="{{ $option->id }}">
                                    <td>
                                        <input type="text" class="form-control" name="options[{{ $option->id }}][title]" value="{{ $option->title }}" required>
                                    </td>
                                    <td>
                                        @if ($option->image)
                                            <img src="{{ asset('storage/uploads/' . $option->image->filename) }}" alt="Current Image" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
                                        @else
                                             {{__('site.question.no_image')}}
                                        @endif
                                    </td>
                                    <td>
                                        <input type="file" class="form-control" name="options[{{ $option->id }}][image]">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" onclick="deleteOption({{ $option->id }})">{{__('site.action.delete')}}</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mb-3">
                        <button type="button" class="btn btn-success" onclick="addNewOption()">{{__('site.action.add_entity', ['entity' => __('site.option.single')])}}</button>
                    </div>

                    <div class="mb-3">
                        <input type="hidden" name="deleted_options[]" id="deleted_options">
                        <button class="btn btn-primary">{{__('site.action.save')}}</button>
                    </div>
                </form>

                <a href="{{ route('questions.index') }}" class="btn btn-secondary mt-3">{{__('site.action.back_to_questions')}}</a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function addNewOption() {
        const tableBody = document.getElementById('options-table-body');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>
                <input type="text" class="form-control" name="new_options[][title]" required>
            </td>
            <td> {{__('site.question.no_image')}}</td>
            <td>
                <input type="file" class="form-control" name="new_options[][image]">
            </td>
            <td>
                <button type="button" class="btn btn-danger" onclick="deleteNewOption(this)">{{__('site.action.delete')}}</button>
            </td>
        `;

        tableBody.appendChild(newRow);
    }

    function deleteNewOption(button) {
        const row = button.closest('tr');
        row.remove();
    }

    function deleteOption(optionId) {
        const row = document.querySelector(`tr[data-id="${optionId}"]`);
        row.style.display = 'none';

        const deletedOptionsInput = document.getElementById('deleted_options');
        const deletedOptions = deletedOptionsInput.value.split(',');

        const filteredOptions = deletedOptions.filter((id) => id !== '');

        const optionIdsArray = optionId.toString().split(',');
        filteredOptions.push(...optionIdsArray);

        deletedOptionsInput.value = filteredOptions.join(',');
    }
</script>
@endpush

@push('styles')

@endpush

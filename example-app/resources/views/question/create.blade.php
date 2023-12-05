

@extends('layouts.myapp')

@section('page_title', __('site.action.create_entity', ['entity' => __('site.question.single')]))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="text-center mb-4 text-light">{{__('site.action.create_entity', ['entity' => __('site.question.single')])}}</h1>
                     @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                   @endif
                <form action="{{ route('questions.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label text-light">{{__('site.question.field.title')}}:</label>
                        <input type="text" class="form-control" name="title" id="title" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label text-light">{{__('site.question.field.description')}}:</label>
                        <textarea class="form-control" name="description" id="description" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="start_at" class="form-label text-light">{{__('site.question.field.start_at')}}:</label>
                        <input type="datetime-local" class="form-control" name="start_at" id="start_at" required>
                    </div>

                    <div class="mb-3">
                        <label for="end_at" class="form-label text-light">{{__('site.question.field.end_at')}}:</label>
                        <input type="datetime-local" accept=".jpg, .png, .jpeg" class="form-control" name="end_at" id="end_at" required>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label text-light">{{__('site.action.select_image')}}:</label>
                        <input type="file" class="form-control" name="image" id="image">
                    </div>
                    
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="active" id="active" checked>
                        <label class="form-check-label text-light" for="active">{{__('site.question.field.active')}}</label>
                    </div>

                    <h2 class="mb-3 text-light">{{__('site.option.plural')}}</h2>

                    <div id="optionsContainer">
                        @for ($i = 0; $i < 2; $i++)
                            <div class="option mb-3">
                                <label for="options[{{ $i }}][title]" class="form-label text-light">{{__('site.option.single')}} {{ $i + 1 }}:</label>
                                <input type="text" class="form-control" name="options[{{ $i }}][title]" required>
                                <div class="row mt-1">
                                    <label for="options[{{ $i }}][image]" class="form-label mt-2"></label>
                                    <input type="file" class="form-control" name="options[{{ $i }}][image]">
                                </div>

                            </div>
                        @endfor
                    </div>

                    <button type="button" class="btn btn-primary mb-3" id="addOption">{{__('site.action.add_entity', ['entity' => __('site.option.single')])}}</button>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">{{__('site.action.create_entity', ['entity' => __('site.question.single')])}}</button>
                    </div>
                </form>

                <a href="{{ route('questions.index') }}" class="btn btn-primary">{{__('site.action.back_to_questions')}} </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const optionsContainer = document.getElementById('optionsContainer');
            const addOptionButton = document.getElementById('addOption');

            let optionCount = 2; 

            addOptionButton.addEventListener('click', function () {
                if (optionCount < 5) { 
                    const newOption = document.createElement('div');
                    newOption.className = 'option mb-3';

                    newOption.innerHTML = `
                        <label for="options[${optionCount}][title]" class="form-label text-light">{{__('site.option.single')}} ${optionCount + 1}:</label>
                        <input type="text" class="form-control" name="options[${optionCount}][title]" required>
                        <div class="row mt-1">
                            <label for="options[${optionCount}][image]" class="form-label mt-2"></label>
                            <input type="file" class="form-control" name="options[${optionCount}][image]">
                         </div>

                    `;

                    optionsContainer.appendChild(newOption);
                    optionCount++;
                }
            });
        });
    </script>
@endpush

@push('styles')

@endpush

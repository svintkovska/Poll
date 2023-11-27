<?php

namespace App\Http\Controllers;

use App\Services\TranslatorService;
use App\Models\Option;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use App\Models\Image;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    private TranslatorService $translatorService;

    public function __construct(TranslatorService $translatorService)
    {
        $this->translatorService = $translatorService;
    }
    public function index()
    {
        $user = auth()->user();
        $questions = $user->questions;

        return view('question.index', [
            'models' => $questions,
            't' => $this->translatorService
        ]);
    }

    public function create()
    {
        return view('question.create');

    }

    public function store(QuestionRequest $request)
    {
        if (!$request->validated()) {
            return redirect()->back()->with('error', 'not valid');
        }
        $question = new Question();
        $question->fill($request->validated() + ['active' => $request->has('active')]);
        if ($request->hasFile('image')) {
            $image = $this->saveImage($request->file('image'));
            if ($image) {
                $question->image()->associate($image);
            }
        }

        $question->search = $this->translatorService->makeSearch($question);

        $question->save();

        $optionsData = $request->input('options', []);
        var_dump($optionsData);
        foreach ($optionsData as $optionIndex => $optionData) {
            $title = $request->input("options.$optionIndex.title");
            $option = new Option(['title' => $title]);

            if ($request->hasFile("options.$optionIndex.image")) {
                $image = $this->saveImage($request->file("options.$optionIndex.image"));
                $option->image_id = $image->id;
            }

            $question->options()->save($option);
        }
        return redirect()->route('questions.index')->with('success', 'Question created successfully!');
    }

    public function show(Question $question)
    {
        return view('question.show', [
            'question' => $question,
            't' => $this->translatorService
        ]);
    }


    public function edit(Question $question)
    {
        return view('question.edit', [
            'model' => $question
        ]);
    }

    public function update(QuestionRequest $request, Question $question)
    {

        if (!$request->validated()) {
            return redirect()->back()->with('error', 'not valid');
        }

        $question->fill($request->validated() + ['active' => $request->has('active')]);
        if ($request->hasFile('new_image')) {

            if ($question->image_id) {
                $this->deleteImage($question->image_id, Question::class);
            }

            $image = $this->saveImage($request->file('new_image'));
            $question->image()->associate($image);
        }
        $question->search = $this->translatorService->makeSearch($question);
        $question->save();

        $optionsData = $request->input('options', []);
        foreach ($optionsData as $optionId => $optionData) {
            $option = Option::findOrFail($optionId);
            if ($option) {
                $option->title = $optionData['title'];
                if ($request->hasFile("options.$optionId.image")) {
                    if ($option->image_id) {
                        $this->deleteImage($option->image_id, Option::class);
                    }
                    $image = $this->saveImage($request->file("options.$optionId.image"));
                    $option->image_id = $image->id;
                }
                $option->save();
            }
        }

        $deletedOptionIds = $request->input('deleted_options', []);
        $deletedOptionIds = isset($deletedOptionIds[0]) ? $deletedOptionIds[0] : '';
        $deletedOptionIds = explode(',', $deletedOptionIds);
        foreach ($deletedOptionIds as $deletedOptionId) {
            $this->deleteOption($deletedOptionId);
        }

        $newOptionsData = $request->input('new_options', []);
        foreach ($newOptionsData as $optionId => $newOptionData) {
            $newOption = new Option(['title' => $newOptionData['title']]);
            if ($request->hasFile("new_options.$optionId.image")) {
                $image = $this->saveImage($request->file("new_options.$optionId.image"), );
                $newOption->image_id = $image->id;
            }

            $question->options()->save($newOption);
        }

        return redirect()->route('questions.index');
    }


    private function deleteOption($optionId)
    {
        $option = Option::find($optionId);

        if ($option) {
            if ($option->image_id) {
                $this->deleteImage($option->image_id, Option::class);
            }
            $option->delete();
        }
    }
    private function saveImage($file)
    {
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $filename = $originalName . '_' . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        Storage::disk('public')->putFileAs('uploads', $file, $filename);
        return Image::create(['filename' => $filename]);
    }

    private function deleteImage($imageId, $modelClass)
    {
        $image = Image::find($imageId);

        if ($image) {
            $filePath = "uploads" . DIRECTORY_SEPARATOR . $image->filename;
            $modelClass::where('image_id', $imageId)->update(['image_id' => null]);
            Storage::disk('public')->delete($filePath);
            $image->delete();
        }
    }

    public function destroy(Question $question)
    {
        foreach ($question->options as $option) {
            $option->votes()->delete();
        }

        if ($question->image) {
            $this->deleteImage($question->image->id, Question::class);
        }

        foreach ($question->options as $option) {
            if ($option->image) {
                $this->deleteImage($option->image->id, Option::class);
            }
            $option->delete();
        }

        $question->delete();

        return redirect()->route('questions.index')->with('success', 'Question deleted successfully!');
    }

}

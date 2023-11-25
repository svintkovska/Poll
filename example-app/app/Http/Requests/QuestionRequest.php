<?php

namespace App\Http\Requests;


use Illuminate\Validation\Rule;
use App\Models\Image;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class QuestionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:254'],
            'description' => ['required', 'string', 'max:2000'],
            'start_at' => ['required', 'date', 'before:end_at'],
            'end_at' => ['required', 'date', 'after:start_at'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048']
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);
        $validated['user_id'] = Auth::user()->getAuthIdentifier();
        return $validated;
    }

}

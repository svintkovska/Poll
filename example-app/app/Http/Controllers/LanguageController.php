<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;

use App\Models\Question;
use App\Models\Vote;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function changeLanguage(string $language): JsonResponse
    {
        $languages = ['uk', 'en'];
        if (!in_array($language, $languages)) {
            return response()->json(['ok' => false, 'language' => app()->getLocale(), 400]);
        }

        session(['language' => $language]);
        return response()->json(['ok' => true, 'language' => $language]);

    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Services\TranslatorService;
use App\Models\Question;
use App\Models\Vote;
use Illuminate\Http\Request;

class PollController extends Controller
{
    private TranslatorService $translatorService;

    public function __construct(TranslatorService $translatorService)
    {
        $this->translatorService = $translatorService;
    }
    public function index(Request $request)
    {
        $query = $request->input('query');

        $activeQuestions = Question::where('active', true)
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where('search', 'like', '%' . $query . '%');
            })
            ->orderBy('start_at', 'asc')
            ->get();

        return view('poll.index', [
            'activeQuestions' => $activeQuestions,
            'query' => $query,
            't' => $this->translatorService
        ]);

    }

    public function show(Question $question)
    {
        $question->load('options');

        return view('poll.vote', [
            'question' => $question,
            't' => $this->translatorService
        ]);
    }
    public function vote(Request $request, Question $question)
    {
        $user = auth()->user();
        try {
            $result = $question->vote($user, $request->input('selected_option'));

            if ($result === 'voted_successfully') {
                Session::flash('success', __('site.sentence.vote_success'));
            } elseif ($result === 'already_voted') {
                Session::flash('warning', __('site.sentence.already_voted'));
            }
        } catch (\Exception $e) {
            Session::flash('error', __('site.sentence.vote_error'));
        }

        return redirect()->back();
    }

}

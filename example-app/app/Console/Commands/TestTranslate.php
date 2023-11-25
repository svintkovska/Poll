<?php

namespace App\Console\Commands;

use App\Models\Question;
use App\Services\TranslatorService;
use Illuminate\Console\Command;

class TestTranslate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-translate';
    private TranslatorService $translatorService;

    public function __construct(TranslatorService $translatorService)
    {
        parent::__construct();
        $this->translatorService = $translatorService;
    }
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach (Question::all() as $question) {
            if (empty($question->search)) {
                $title = $question->title;
                $result = $title;
                $langs = ['uk', 'en'];
                foreach ($langs as $lang) {
                    $result .= ' ' . $this->translatorService->translate($title, $lang);
                }
                $question->search = $result;
                $question->save();
            }
        }
    }
}

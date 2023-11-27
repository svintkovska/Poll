<?php

namespace Tests\Unit;

use App\Models\Question;
use App\Services\TranslatorService;

use Tests\TestCase;

class TranslatorServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get("/");

        $response->assertStatus(200);
    }
    public function test_example(): void
    {
        $translator = app()->get(TranslatorService::class);
        $this->assertInstanceOf(TranslatorService::class, $translator);
    }

    public function test_translate(): void
    {
        $translator = app()->get(TranslatorService::class);
        $this->assertEquals('Тест', $translator->translate('Test', 'uk'));
    }

    public function test_make_question_search(): void
    {
        $translator = app()->get(TranslatorService::class);
        $question = new Question(['title' => 'Apple']);
        $search = $translator->makeSearch($question);
        $this->assertStringContainsStringIgnoringCase('Яблуко', $search);
    }
}

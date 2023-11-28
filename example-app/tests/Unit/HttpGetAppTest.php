<?php

namespace Tests\Unit;

use App\Models\Question;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class HttpGetAppTest extends TestCase
{
    use RefreshDatabase;

    protected function authenticateUser()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        return $user;
    }
    public function test_public_index_page(): void
    {
        $response = $this->get(route('poll.index'));
        $response->assertStatus(200);
    }
    public function test_public_show_page(): void
    {
        $user = $this->authenticateUser();
        $question = Question::factory()->for($user)->create();

        $response = $this->get(route('poll.show', ['question' => $question->id]));
        $response->assertStatus(200);
        $response->assertSeeText($question->title);

    }

    public function test_auth_questions_page(): void
    {
        $this->authenticateUser();
        $response = $this->get(route('questions.index'));
        $response->assertStatus(200);
    }

    public function test_auth_question_edit_page(): void
    {
        $user = $this->authenticateUser();
        $question = Question::factory()->for($user)->create();

        $response = $this->get(route('questions.edit', ['question' => $question->id]));
        $response->assertStatus(200);
    }
    public function test_auth_question_create_page(): void
    {
        $this->authenticateUser();
        $response = $this->get(route('questions.create'));
        $response->assertStatus(200);
    }
    public function test_auth_question_show_page(): void
    {
        $user = $this->authenticateUser();
        $question = Question::factory()->for($user)->create();

        $response = $this->get(route('questions.show', ['question' => $question->id]));
        $response->assertStatus(200);
    }
}

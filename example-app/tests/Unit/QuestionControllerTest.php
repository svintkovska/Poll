<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Question;
use App\Models\Option;
use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class QuestionControllerTest extends TestCase
{
    //use RefreshDatabase;

    protected function authenticateUser()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        return $user;
    }

    public function test_store_method_creates_question_and_options()
    {
        Storage::fake('public');

        $user = $this->authenticateUser();

        $file = UploadedFile::fake()->image('test_image.jpg');

        $response = $this->actingAs($user)->post(route('questions.store'), [
            'title' => 'Test Question',
            'description' => 'Test Description',
            'start_at' => now(),
            'end_at' => now()->addDays(1),
            'image' => $file,
            'active' => true,
            'options' => [
                [
                    'title' => 'Option 1',
                    'image' => $file,
                ],
                [
                    'title' => 'Option 2',
                    'image' => $file,
                ],
            ],
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('questions', ['title' => 'Test Question']);

        $question = Question::where('title', 'Test Question')->first();
        $this->assertNotNull($question, 'Question not found in the database.');

        $optionsCount = $question->options()->count();
        $this->assertEquals(2, $optionsCount, "Expected 2 options, but found $optionsCount.");

    }

    public function test_update_method_updates_question_and_options()
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $this->actingAs($user);

        $question = Question::create([
            'title' => 'Test Question',
            'description' => 'Test Description',
            'start_at' => now(),
            'end_at' => now()->addDays(1),
            'user_id' => $user->id,
        ]);

        $option1 = Option::create(['title' => 'Option 1', 'question_id' => $question->id]);
        $option2 = Option::create(['title' => 'Option 2', 'question_id' => $question->id]);

        $file = UploadedFile::fake()->image('test_image.jpg');

        $response = $this->post(route('questions.update', ['question' => $question->id]), [
            'title' => 'Updated Question',
            'description' => 'Updated Description',
            'start_at' => now(),
            'end_at' => now()->addDays(2),
            'new_image' => $file,
            'active' => true,
            'options' => [
                $option1->id => [
                    'title' => 'Updated Option 1',
                    'image' => $file,
                ],
                $option2->id => [
                    'title' => 'Updated Option 2',
                    'image' => $file,
                ],
            ],
        ]);

        $response->assertRedirect(route('questions.index'));

        $updatedQuestion = Question::find($question->id);

        // Assert that the question and options are updated
        $this->assertEquals('Updated Question', $updatedQuestion->title);
        $this->assertEquals('Updated Description', $updatedQuestion->description);
        $this->assertEquals(2, $updatedQuestion->options->count());

    }



}

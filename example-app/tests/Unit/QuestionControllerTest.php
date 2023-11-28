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
    use RefreshDatabase;

    protected function authenticateUser()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        return $user;
    }

    public function test_store_question()
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
        ]);

        $response->assertRedirect(route('questions.index'));
        $this->assertDatabaseCount('questions', 1);
        $this->assertDatabaseHas('questions', ['title' => 'Test Question']);
    }


    public function test_update_question()
    {
        Storage::fake('public');
        $user = $this->authenticateUser();
        $question = Question::factory()->for($user)->create();
        $file = UploadedFile::fake()->image('test_image.jpg');

        $response = $this->post(route('questions.update', ['question' => $question->id]), [
            'title' => 'Updated Question',
            'description' => 'Updated Description',
            'start_at' => now(),
            'end_at' => now()->addDays(2),
            'new_image' => $file,
            'active' => true
        ]);

        $response->assertRedirect(route('questions.index'));

        $updatedQuestion = Question::find($question->id);

        $this->assertEquals('Updated Question', $updatedQuestion->title);
        $this->assertEquals('Updated Description', $updatedQuestion->description);

    }


    public function test_destroy_question()
    {
        $user = $this->authenticateUser();
        $question = Question::factory()->for($user)->create();
        $response = $this->delete(route('questions.destroy', ['question' => $question->id]));
        $response->assertRedirect(route('questions.index'));
        $this->assertDatabaseMissing('questions', ['id' => $question->id]);
    }

}

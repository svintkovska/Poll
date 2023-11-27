<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Question;
use App\Models\Option;

class PollControllerTest extends TestCase
{
    protected function authenticateUser()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        return $user;
    }

    public function test_vote_method_votes_for_question_option()
    {
        $user = $this->authenticateUser();
        $question = Question::create([
            'title' => 'Test Question',
            'description' => 'Test Description',
            'start_at' => now(),
            'end_at' => now()->addDays(1),
            'user_id' => $user->id
        ]);

        $option = Option::create([
            'title' => 'Test Option',
            'question_id' => $question->id,
        ]);

        $response = $this->post(route('poll.vote', ['question' => $question->id]), [
            'selected_option' => $option->id,
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('votes', [
            'user_id' => $user->id,
            'option_id' => $option->id,
        ]);
    }
}

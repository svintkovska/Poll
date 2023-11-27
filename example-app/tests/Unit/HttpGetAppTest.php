<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class HttpGetAppTest extends TestCase
{
    public function test_public_index_page_response(): void
    {
        $response = $this->get("/");

        $response->assertStatus(200);
    }
    public function test_public_show_page_response(): void
    {
        $response = $this->get("/poll/2/show");

        $response->assertStatus(200);
    }

    public function test_auth_questions_page_response(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get("/questions");

        $response->assertStatus(200);
    }

    public function test_auth_question_edit_page_response(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get("/question/2/edit");

        $response->assertStatus(200);
    }
    public function test_auth_question_create_page_response(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get("/questions/create");

        $response->assertStatus(200);
    }
    public function test_auth_question_show_page_response(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get("/question/2/show");

        $response->assertStatus(200);
    }
}

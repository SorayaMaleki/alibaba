<?php

namespace Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateArticleTest extends TestCase
{
    use RefreshDatabase;

    private const ROUTE = 'articles.create';

    /** @test */
    public function it_returns_edit_view_with_article()
    {
        // Create a test article
        $user = User::factory()->create();
        $this->actingAs($user);
        // Access the edit route for the article
        $response = $this->get(route(self::ROUTE));

        // Assert the response status is 200 (OK)
        $response->assertStatus(200);

        // Assert that the response contains the create view
        $response->assertViewIs(self::ROUTE);
    }

}


<?php

namespace Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowArticleTest extends TestCase
{
    use RefreshDatabase;

    private const ROUTE = 'articles.show';

    /** @test */
    public function it_returns_edit_view_with_article()
    {
        // Create a test article
        $user=User::factory()
            ->has(Article::factory()->count(1))
            ->create();
        $article=$user->articles->first();
        $this->actingAs($user);
        // Access the edit route for the article
        $response = $this->get(route(self::ROUTE, ['article' => $article]));

        // Assert the response status is 200 (OK)
        $response->assertStatus(200);

        // Assert that the response contains the edit view
        $response->assertViewIs(self::ROUTE);

        // Assert that the article data is being passed to the view
        $response->assertViewHas('article', $article);
    }

}

<?php

namespace Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestroyArticleTest extends TestCase
{
    use RefreshDatabase;

    private const ROUTE = 'articles.destroy';

    /** @test */
    public function it_denies_access_to_unauthorized_user()
    {
        $article = Article::factory()->create();
        $unauthorized_user = User::factory()->create();
        $this->actingAs($unauthorized_user);
        $response = $this->delete(route(self::ROUTE, ['article' => $article]));
        $response->assertStatus(403); // Ensure unauthorized user receives forbidden status
    }

    /** @test */
    public function it_can_approve_an_article()
    {
        $article = Article::factory()->create();
        $user = User::factory()->isAdmin()->create();
        $this->actingAs($user);
        $response = $this->delete(route(self::ROUTE, ['article' => $article]));
        $response->assertStatus(302)
            ->assertRedirect(route('articles.index'))
            ->assertSessionHas('message', 'The article has been destroyed');
        $this->assertDatabaseMissing('articles', $article->toArray());
    }
}

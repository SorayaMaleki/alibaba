<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateArticleTest extends TestCase
{
    use RefreshDatabase;

    private const ROUTE = 'articles.update';

    /** @test */
    public function it_can_update_an_article()
    {
        // Create a test article
        $user = User::factory()->create();
        $article = Article::factory()->make([
            'user_id' => $user->id,
            "status" => ""
        ]);
        $storedArticle=Article::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);

        $response = $this->put(route(self::ROUTE, ['article' => $storedArticle]),$article->toArray());

        $response->assertStatus(302)
            ->assertRedirect(route('articles.show',['article'=>$storedArticle]))
            ->assertSessionHas('message', 'The article has been updated');
        $updatedArticle = Article::get()->first();
        $this->assertEquals($updatedArticle->title, $article->title);
        $this->assertEquals($updatedArticle->content, $article->content);
        $this->assertEquals($updatedArticle->user_id, $article->user_id);
        $this->assertEquals("draft", $updatedArticle->status);
        $this->assertNull($updatedArticle->publish_date);
    }
}

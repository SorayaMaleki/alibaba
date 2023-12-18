<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreArticleTest extends TestCase
{
    use RefreshDatabase;

    private const ROUTE = 'articles.store';

    /** @test */
    public function it_can_create_an_article()
    {
        // Create a test article
        $user = User::factory()->create();
        $article = Article::factory()->make([
            'user_id' => $user->id,
            "status" => ""
        ]);
        $this->actingAs($user);

        $response = $this->post(route(self::ROUTE), $article->toArray());

        $response->assertStatus(200)
            ->assertViewIs('articles.show')
            ->assertViewHas('message', 'The article has been stored');

        $storedArticle = Article::get()->first();
        $this->assertEquals($storedArticle->title, $article->title);
        $this->assertEquals($storedArticle->content, $article->content);
        $this->assertEquals($storedArticle->user_id, $article->user_id);
        $this->assertEquals("draft", $storedArticle->status);
        $this->assertNull($storedArticle->publish_date);
    }
}

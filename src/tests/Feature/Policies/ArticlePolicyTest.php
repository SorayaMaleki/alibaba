<?php


namespace Policies;

use App\Models\Article;
use App\Models\User;
use App\Policies\ArticlePolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticlePolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_view_any_articles()
    {
        $user = User::factory()->create();
        $articlePolicy = new ArticlePolicy();

        $result = $articlePolicy->viewAny($user);

        $this->assertTrue($result);
    }

    /** @test */
    public function user_can_view_own_article()
    {
        $user = User::factory()->create();
        $article = Article::factory()->create(['user_id' => $user->id]);
        $articlePolicy = new ArticlePolicy();

        $result = $articlePolicy->view($user, $article);

        $this->assertTrue($result);
    }

    // More test cases for other methods in the policy...

    /** @test */
    public function user_can_create_article()
    {
        $user = User::factory()->create();
        $articlePolicy = new ArticlePolicy();

        $result = $articlePolicy->create($user);

        $this->assertTrue($result);
    }

    /** @test */
    public function user_can_update_own_article()
    {
        $user = User::factory()->create();
        $article = Article::factory()->create(['user_id' => $user->id]);
        $articlePolicy = new ArticlePolicy();

        $result = $articlePolicy->update($user, $article);

        $this->assertTrue($result);
    }

    /** @test */
    public function admin_can_delete_article()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $article = Article::factory()->create();
        $articlePolicy = new ArticlePolicy();

        $result = $articlePolicy->delete($admin, $article);

        $this->assertTrue($result);
    }

    /** @test */
    public function user_cannot_delete_article()
    {
        $user = User::factory()->create();
        $article = Article::factory()->create();
        $articlePolicy = new ArticlePolicy();

        $result = $articlePolicy->delete($user, $article);

        $this->assertFalse($result);
    }

    /** @test */
    public function admin_can_restore_own_article()
    {
        $user = User::factory()->create(['is_admin' => true]);
        $article = Article::factory()->create();
        $articlePolicy = new ArticlePolicy();

        $result = $articlePolicy->restore($user, $article);

        $this->assertTrue($result);
    }

    /** @test */
    public function admin_can_approve_article()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $articlePolicy = new ArticlePolicy();

        $result = $articlePolicy->approve($admin);

        $this->assertTrue($result);
    }

    /** @test */
    public function user_cannot_approve_article()
    {
        $user = User::factory()->create();
        $articlePolicy = new ArticlePolicy();

        $result = $articlePolicy->approve($user);

        $this->assertFalse($result);
    }

}

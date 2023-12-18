<?php

namespace Tests\Unit\Services;

use App\Models\Article;
use App\Repositories\ArticleRepositoryInterface;
use App\Services\ArticleService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Mockery;
use PHPUnit\Framework\TestCase;


class ArticleServiceTest extends TestCase
{
    public function setUp(): void
    {
        // Create a mock user
        $user = Mockery::mock(Authenticatable::class);
        $user->id = 1;
        $user->name = "asasas";
        $user->is_admin = 1;

        // Mock the behavior of Auth::user() to return the mock user
        Auth::shouldReceive('user')->andReturn($user);
        $this->reposirory = Mockery::mock(ArticleRepositoryInterface::class);

    }

    public function tearDown(): void
    {
        Mockery::close();
    }

    /** @test */
    public function it_creates_an_article()
    {
        $this->reposirory->shouldReceive('create')->once()->andReturn(new Article());

        $service = new ArticleService($this->reposirory);
        $article = $service->createArticle([
            'title' => 'Test Article',
            'content' => 'This is a test article content.',
        ]);
        $this->assertInstanceOf(Article::class, $article);
    }

    /** @test */
    public function it_gets_all_articles()
    {
        $this->reposirory->shouldReceive('all')->once()->andReturn(new Collection());

        $service = new ArticleService($this->reposirory);
        $articles = $service->getAllArticles();

        $this->assertInstanceOf(Collection::class, $articles);
    }

    /** @test */
    public function it_finds_an_article()
    {
        $article = new Article();
        $article->id = 1;
        $this->reposirory->shouldReceive('find')->once()->andReturn(new Article());

        $service = new ArticleService($this->reposirory);
        $FoundArticle = $service->findArticle($article);

        $this->assertInstanceOf(Article::class, $FoundArticle);
    }

    public function it_finds_a_non_existing_article()
    {
        $article = new Article();
        $article->id = 1;
        $this->reposirory->shouldReceive('find')
            ->once()->andThrow(new ModelNotFoundException());

        $service = new ArticleService($this->reposirory);
        $this->expectException(ModelNotFoundException::class);
        $service->findArticle($article);
    }

    /** @test */
    public function it_deletes_a_article()
    {
        $article = new Article();
        $article->id = 1;
        $this->reposirory->shouldReceive('delete')->with($article)->once()->andReturn(true);

        $service = new ArticleService($this->reposirory);
        $result = $service->deleteArticle($article);

        $this->assertTrue($result);
    }

    /** @test */
    public function it_deletes_a_non_existing_article()
    {
        $article = new Article();
        $article->id = 999;
        $this->reposirory->shouldReceive('delete')
            ->once()->andThrow(new ModelNotFoundException());

        $service = new ArticleService($this->reposirory);
        $this->expectException(ModelNotFoundException::class);
        $service->deleteArticle($article);
    }

    /** @test */
    public function it_updates_an_article()
    {
        $this->reposirory->shouldReceive('update')->once()->andReturn(new Article());
        $article = new Article();
        $article->id = 999;
        $article->title = "Test Article1";
        $article->content = "This is a test article content1";

        $service = new ArticleService($this->reposirory);
        $UpdatedArticle = $service->updateArticle([
            'title' => 'Test Article2',
            'content' => 'This is a test article content.2',
        ], $article);
        $this->assertInstanceOf(Article::class, $UpdatedArticle);
    }

    /** @test */
    public function it_not_updates_a_non_existing_article()
    {
        $article = new Article();
        $article->id = 999;
        $article->title = "Test Article1";
        $article->content = "This is a test article content1";
        $this->reposirory->shouldReceive('update')
            ->once()->andThrow(new ModelNotFoundException());

        $service = new ArticleService($this->reposirory);
        $this->expectException(ModelNotFoundException::class);
        $UpdatedArticle = $service->updateArticle([
            'title' => 'Test Article2',
            'content' => 'This is a test article content.2',
        ], $article);
    }
}

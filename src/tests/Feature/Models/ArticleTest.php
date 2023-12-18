<?php

namespace Tests\Feature\Models;

use App\Models\Article;
use App\Models\Client;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Permission;
use App\Models\TempMessage;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\models\ModelHelperTesting;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;
    public function testInsertData()
    {
        $data = Article::factory()->make()->toArray();
        Article::create($data);
        $this->assertDatabaseHas("articles", $data);
    }
    public function testCustomerRelationWithOrder()
    {
        $article=Article::factory()->create();
        $this->assertTrue(isset($article->user_id));
        $this->assertTrue($article->user->first() instanceof User);
    }

}

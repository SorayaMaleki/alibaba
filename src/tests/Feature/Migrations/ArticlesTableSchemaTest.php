<?php

namespace Tests\Feature\Migrations;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ArticlesTableSchemaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function orders_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('articles', [
                'user_id',
                'title',
                'content',
                'status',
                'publish_date',
            ])
        );
    }
}

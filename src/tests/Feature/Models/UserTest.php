<?php

namespace Tests\Feature\Models;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function dd;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testInsertData()
    {
        $data = User::factory()->create();
        $user = User::first();
        $this->assertEquals($data->name, $user->name);
        $this->assertEquals($data->email, $user->email);
        $this->assertEquals($data->is_admin, $user->is_admin);
    }

    public function testCustomerRelationWithOrder()
    {
        $count = rand(1, 10);
        $user = User::factory()
            ->has(Article::factory()->count($count))
            ->create();
        $this->assertCount($count, $user->articles);
        $this->assertTrue($user->articles->first() instanceof Article);
    }

    /** @test */
    public function only_fillable_fields_can_be_mass_assigned()
    {
        // Attempt to create a user with non-fillable fields
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt("123"),
            'is_admin' => false,
            'remember_token' => "hjgfjfjfjfj", // non-fillable field
            'email_verified_at' => "hjgfjfjfjfj", // non-fillable field
        ]);

        // Fetch the user from the database
        $savedUser = User::find($user->id);

        // Assert that non-fillable fields are not assigned
        $this->assertNull($savedUser->remember_token);
        $this->assertNull($savedUser->email_verified_at);
    }
}

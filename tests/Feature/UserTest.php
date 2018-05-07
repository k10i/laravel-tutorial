<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;

class UserTest extends TestCase
{
   use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);

        $user = factory(User::class)->create(
            ['email' => 'sally@example.com']
        );

        $this->assertDatabaseHas('users', [
            'email' => 'sally@example.com'
        ]);
    }
}

<?php

namespace Tests\Feature\HttpApi;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;
use Tests\TestCase;

class TestLoginController extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test logging in successfully using the routed defined
     *
     * @return void
     */
    public function testRightCredentialsOnLogIn(): void
    {
        $password = 'test123';

        /** @var User $user */
        $user = User::factory()->create([
            'password' => bcrypt($password),
        ]);

        $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => $password,
        ])->assertStatus(200);
    }

    /**
     * Test logging in with wrong credentials using the routed defined
     *
     * @return void
     */
    public function testWrongCredentialsOnLogIn(): void
    {
        $password = 'test123';

        /** @var User $user */
        $user = User::factory()->create([
            'password' => bcrypt($password),
        ]);

        $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'hello123',
        ])->assertStatus(401);
    }
}

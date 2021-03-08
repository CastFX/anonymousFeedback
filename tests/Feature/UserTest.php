<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;


    public function test_can_create_a_user()
    {
        $user = User::factory()->make();


        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->rememberToken();
        $table->timestamps();
        $response = $this->post(route('user.store'), [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(10)
            ->create()
            ->each(function ($user) {
                $feedbacks = Feedback::factory()
                    ->count(11)
                    ->make();

                foreach($feedbacks as $feedback) {
                    $feedback->email = $user->email;
//                    print($feedback->email);
//                    print("\n");
                    $user->feedbacks()->save($feedback);
                }
            });

        $defaultUser = User::factory()->make();
        $defaultUser->name = "tester";
        $defaultUser->email = "test@test.com";
        $defaultUser->save();
    }
}

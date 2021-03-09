<?php

namespace Database\Seeders;

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Database\Seeder;

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
                    ->count(4)
                    ->make();

                foreach($feedbacks as $feedback) {
                    $feedback->email = $user->email;
//                    print($feedback->email);
//                    print("\n");
                    $user->feedbacks()->save($feedback);
                }
            });
    }
}

<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Psy\CodeCleaner\UseStatementPass;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'name' => 'Rafael Madrigal'
        ]);
        Post::factory(5)->create([
            'user_id' => $user->id
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Peter James',
            'email' => 'james@example.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $cat1 = $user->categories()->create(['name' => 'General', 'slug' => 'general']);
        $cat2 = $user->categories()->create(['name' => 'Sports', 'slug' => 'sports']);

        $cat1->tasks()->createMany([
            [
                'title' => 'Prepare for exams',
                'slug' => Str::slug('Prepare for exams'),
                'is_public' => true,
                'status' => 'todo',
                'user_id' => $user->id
            ],
            [
                'title' => 'Go for hiking',
                'slug' => Str::slug('Go for hiking'),
                'is_public' => true,
                'status' => 'done',
                'user_id' => $user->id
            ],
            [
                'title' => 'Look at Vue 3',
                'slug' => Str::slug('Look at Vue 3'),
                'is_public' => false,
                'status' => 'doing',
                'user_id' => $user->id
            ],
        ]);

        $cat2->tasks()->createMany([
            [
                'title' => 'Gym classes',
                'slug' => Str::slug('Gym classes'),
                'is_public' => true,
                'status' => 'doing',
                'user_id' => $user->id
            ],
            [
                'title' => 'Evening rums',
                'slug' => Str::slug('Evening rums'),
                'is_public' => true,
                'status' => 'doing',
                'user_id' => $user->id
            ],
            [
                'title' => 'Basketball training',
                'slug' => Str::slug('Basketball training'),
                'is_public' => false,
                'status' => 'todo',
                'user_id' => $user->id
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        // We can make it easier by adding our seeders to the main DatabaseSeeder class inside the database/seeds folder:
        // $ php artisan db:seed
        // $this->call(ArticlesTableSeeder::class);
        // $this->call(UsersTableSeeder::class);

//        $this->call(UsersTableSeeder::class);
//        $this->call(PostsTableSeeder::class);

        $this->call(BookmarkTableSeeder::class);
    }
}

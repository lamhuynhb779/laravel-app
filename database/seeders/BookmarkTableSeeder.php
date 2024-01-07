<?php

namespace Database\Seeders;

use App\Models\Bookmark;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookmarkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

//        for ($i=0; $i < 5000000; $i++) {
//            Bookmark::create([
//                'user_id' => $faker->randomDigitNotZero(),
//                'url' => $faker->url(),
//                'bookmark_at' => $faker->dateTime()->format('Y-m-d H:i:s'),
//            ]);
//        }
        ini_set('max_execution_time', 0); // 0 = Unlimited
        ini_set('memory_limit', '-1'); //allocate memory
        DB::disableQueryLog();

        for ($i = 0; $i <500000; $i++) {
            $time = $faker->dateTime()->format('Y-m-d H:i:s');
            DB::table('bookmarks')->insert([
                'user_id' => $faker->randomDigitNotZero(),
                'url' => $faker->url(),
                'bookmark_at' => $time,
                'created_at' => $time,
                'updated_at' => $time,
            ]);
        }

    }
}

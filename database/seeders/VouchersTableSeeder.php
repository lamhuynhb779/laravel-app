<?php

namespace Database\Seeders;

use App\Models\Vouchers;
use Illuminate\Database\Seeder;

class VouchersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Vouchers::truncate();

        \App\Models\Vouchers::factory()->count(1)->create();
    }
}

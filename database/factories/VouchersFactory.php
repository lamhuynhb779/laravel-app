<?php

namespace Database\Factories;

use App\Models\Vouchers;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VouchersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vouchers::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'voucher_id' => 1,
            'code' => Str::random(8),
            'expired_date' => $this->faker->date(),
            'user_uuid' => null,
        ];
    }
}

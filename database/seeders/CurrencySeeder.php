<?php

namespace Database\Seeders;

use App\Feature\CurrencyConversion\Domain\Models\Currency;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Indian Ruppee',
                'symbol' => 'INR',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Euro',
                'symbol' => 'EUR',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'US Dollar',
                'symbol' => 'USD',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'United Arab Emirates Dirham',
                'symbol' => 'AED',
                'created_at' => Carbon::now()
            ]
        ];

        Currency::insert($data);
    }
}

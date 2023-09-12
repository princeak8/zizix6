<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ConversionRate;

class ConversionRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rate = new ConversionRate;
        $rate->dollar = 925;
        $rate->pounds = 1183;
        $rate->euro = 980;
        $rate->save();
    }
}

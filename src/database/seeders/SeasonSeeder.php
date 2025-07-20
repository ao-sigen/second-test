<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SeasonSeeder extends Seeder
{
    public function run(): void
    {
        $seasons = ['春', '夏', '秋', '冬'];

        foreach ($seasons as $season) {
            DB::table('seasons')->insert([
                'name' => $season,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}

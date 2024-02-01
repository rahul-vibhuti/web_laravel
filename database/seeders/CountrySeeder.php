<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PHPUnit\Framework\Constraint\Count;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'united kingdom', 'short_name' => 'uk', 'code' => '1'],
            ['name' => 'united states', 'short_name' => 'us', 'code' => '2'],
            ['name' => 'India', 'short_name' => 'in', 'code' => '91'],
        ];


        Country::truncate();

        foreach ($data as $row) {
            $cat = new Country();
            $cat->name = $row['name'];
            $cat->short_name = $row['short_name'];
            $cat->code = $row['code'];
            $cat->save();
        }
    }
}

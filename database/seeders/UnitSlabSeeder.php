<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UnitSlab;
class UnitSlabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $slabs = [
            ['unit_from' => 1, 'unit_to' => 50,'price' => 5],
            ['unit_from' => 51, 'unit_to' => 100 ,'price' => 8],
            ['unit_from' => 101, 'unit_to' => 250,'price' => 12],
            ['unit_from' => 251, 'unit_to' =>   10000 ,'price' => 15],
        ];
        foreach ($slabs as $slab) {
        UnitSlab::create($slab);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i=0; $i < 100 ; $i++) {
            Barang::create([
                'kodeBarang' => $faker->numberBetween(1,100)."FSI",
                'namaBarang' => $faker->name
            ]);
        }
    }
}

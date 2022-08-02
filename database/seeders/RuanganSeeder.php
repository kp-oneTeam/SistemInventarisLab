<?php

namespace Database\Seeders;
use App\Models\Ruangan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create('id_ID');
        for ($i=0; $i < 100 ; $i++) {
            Ruangan::create([
                'kodeRuangan' => $faker->numberBetween(1,100)."RFSI",
                'namaRuangan' => $faker->name,
                'namaGedung' => $faker->name
            ]);
        }
    }
}

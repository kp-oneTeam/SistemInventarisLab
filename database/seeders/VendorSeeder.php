<?php

namespace Database\Seeders;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class VendorSeeder extends Seeder
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
            Vendor::create([
                'kodeVendor' => $faker->numberBetween(1,100)."VFSI",
                'namaVendor' => $faker->name
            ]);
        }
    }
}

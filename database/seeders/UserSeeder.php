<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::create([
            'nama' => 'Herdi Ashaury, S.Kom., M.T',
            'username' => 'admin',
            'password' => bcrypt('admin')
        ]);
        $role = Role::create(['name' => 'kepala lab']);
        $role2 = Role::create(['name' => 'laboran']);
        $user->assignRole([$role->id]);
    }
}

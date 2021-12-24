<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'alamat' => 'bangil',
            'no_hp' => '089512977949',
            'password' => bcrypt('admin')
        ]);

        $admin->assignRole('admin');

        // $users = User::create([
        //     'name' => 'usergans',
        //     'email' => 'user@gmail.com',
        //     'alamat' => 'bangil',
        //     'no_hp' => '089512977949',
        //     'password' => bcrypt('usergans')
        // ]);

        // $users->assignRole('user');
    }
}

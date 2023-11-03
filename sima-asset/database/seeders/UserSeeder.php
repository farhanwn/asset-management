<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'role_id'=>1,
                'name'=>'Super Admin',
                'username'=>'superadmin',
                'jabatan'=>'Staff',
                'nip'=>'0',
                'email'=>'superadmin@email.com',
                'password'=>bcrypt('admin123')
            ]
        ]);
    }
}

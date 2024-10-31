<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Pedro',
            'email' => 'pedro@gmail',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('123456789'), // para criptografar a senha
        ]);
    }
}


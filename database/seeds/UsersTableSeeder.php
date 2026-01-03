<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nonaktifkan foreign key check (penting kalau ada relasi)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Hapus semua data + reset auto increment
        DB::table('users')->truncate();

        // Aktifkan kembali foreign key check
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Insert ulang data
        DB::table('users')->insert([
            'full_name' => 'Rizal Mukhaimin',
            'email'     => 'rizalmukhaimin@gmail.com',
            'username'  => 'admin',
            'password'  => Hash::make('admin'),
            'avatar'    => '898192462.png',
        ]);
    }
}

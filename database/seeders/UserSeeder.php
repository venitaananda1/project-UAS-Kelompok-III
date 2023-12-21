<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//improt facedes DB
use Illuminate\Support\Facades\DB;
//import hash utk enkrepksi
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //kode ini untk improt data ke tabel user
        DB::table("users")->insert([
            'name'=> 'admin',
            'email'=>'admin123@gmail.com',
            'password'=>Hash::make('admin123'),

        ]);
    }
}
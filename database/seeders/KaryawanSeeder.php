<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('karyawan')->insert([ 
        	[
                'nip' => '1234',
                'nama' => 'DONI',
                'jabatan' => 'DIREKTUR',
                'password' => Hash::make('123456')
            ],[
                'nip' => '1235',
                'nama' => 'DONO',
                'jabatan' => 'FINANCE',
                'password' => Hash::make('123456')
            ],[
                'nip' => '1236',
                'nama' => 'DONA',
                'jabatan' => 'STAFF',
                'password' => Hash::make('123456')
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProviderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provider')->insert([
            'name' => 'RZM Kakau',
            'description' => 'produtor de cacau orgânico',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('provider')->insert([
            'name' => 'RZM Organic',
            'description' => 'produtor de cacau orgânico',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('provider')->insert([
            'name' => 'RZM Foods Brazil',
            'description' => 'produtor de cacau pré-processado (pasta base)',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}

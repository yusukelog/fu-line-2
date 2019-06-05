<?php

use Illuminate\Database\Seeder;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => '桐谷',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('people')->insert($param);

        $param = [
            'name' => '水城',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('people')->insert($param);
    }
}

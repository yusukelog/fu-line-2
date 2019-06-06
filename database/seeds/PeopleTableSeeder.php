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
            //'old' => '21',
            'tall' => '163',
            'bust' => '87',
            'cup' => 'E',
            'west' => '56',
            'hip' => '83',
            'url' => 'http://www.elegaku.com/profile/top/castCode/136055/',
            'code' => '136055',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('people')->insert($param);

        $param = [
            'name' => '水城',
            //'old' => '20',
            'tall' => '169',
            'bust' => '98',
            'cup' => 'G',
            'west' => '58',
            'hip' => '86',
            'url' => 'http://www.elegaku.com/profile/top/castCode/137937/',
            'code' => '137937',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('people')->insert($param);
    }
}

<?php

use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{
    public function run()
    {
        DB::table('languages')->insert([
            [
            'name' => 'Polski',
            'slug'=>'pl',
            'file'=>'poland.png',
            'active'=>1
        ],[
            'name' => 'English',
            'slug'=>'en',
            'file'=>'english.png',
            'active'=>0,
        ],[
            'name' => 'German',
            'slug'=>'de',
            'file'=>'german.png',
            'active'=>0,

            ]]);
    }
}
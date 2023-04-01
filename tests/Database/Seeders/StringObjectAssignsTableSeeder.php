<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StringObjectAssignsTableSeeder extends Seeder {
	
    public function run() {
        DB::table('stringobjectassigns')->truncate();
        DB::table('stringobjectassigns')->insert([
            ['container_id'=>1,'element_id'=>'Author','field'=>'groups','index'=>0],
            ['container_id'=>1,'element_id'=>'Actor', 'field'=>'groups','index'=>1],
            ['container_id'=>1,'element_id'=>'Richard Bachmann', 'field'=>'aliases','index'=>0],
        ]);
    }

}
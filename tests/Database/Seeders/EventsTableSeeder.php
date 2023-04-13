<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventsTableSeeder extends Seeder {
    
    public function run() {
        DB::table('sunhillevents')->truncate();
        DB::table('sunhillevents')->insert([
            ['id'=>1,'object_id'=>42,'type_id'=>1,'stamp'=>'2022-11-04 00:00:00'],
        ]);
    }
}
<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventTypesTableSeeder extends Seeder {
    
    public function run() {
        DB::table('eventtypes')->truncate();
        DB::table('eventtypes')->insert([
            ['id'=>1,'name'=>'watched','allowed_objects'=>'VisualWork','type'=>'happening'],
            ['id'=>2,'name'=>'listened','allowed_objects'=>'MusicalTrack','type'=>'happening'],
            ['id'=>3,'name'=>'read','allowed_objects'=>'WrittenWork','type'=>'happening'],
            ['id'=>4,'name'=>'change','allowed_objects'=>'Object','type'=>'change'],
        ]);
    }
}
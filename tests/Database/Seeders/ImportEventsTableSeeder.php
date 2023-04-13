<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImportEventsTableSeeder extends Seeder {
    
    public function run() {
        DB::table('import_events')->truncate();
        DB::table('import_events')->insert([
            ['id'=>1,'refering_table'=>'import_movies','refering_id'=>1,'event_type'=>'watch','date'=>'2022-11-04','event_id'=>0],
            ['id'=>2,'refering_table'=>'import_movies','refering_id'=>3,'event_type'=>'watch','date'=>'2022-11-04','event_id'=>1],
        ]);
    }
}
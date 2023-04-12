<?php

namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder {
	
	public function run() {
		DB::table('tags')->truncate();
	    DB::table('tags')->insert([
		    ['id'=>1,'name'=>'Simpsons','parent_id'=>0,'options'=>0],
	        ['id'=>2,'name'=>'Fiction','parent_id'=>0,'options'=>0],
	        ['id'=>3,'name'=>'Horror','parent_id'=>2,'options'=>0],
	    ]);
	}
}
<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagObjectAssignsTableSeeder extends Seeder {
	
	public function run() {
	    DB::table('tagobjectassigns')->truncate();
	    DB::table('tagobjectassigns')->insert([
	        ['container_id'=>1,'tag_id'=>3],
	        
	        ['container_id'=>5,'tag_id'=>1],
	        ['container_id'=>6,'tag_id'=>1],
	        ['container_id'=>7,'tag_id'=>1],	        
	        ['container_id'=>8,'tag_id'=>1],
	        ['container_id'=>9,'tag_id'=>1],
	    ]);
	}
}
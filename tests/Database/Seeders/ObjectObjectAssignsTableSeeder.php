<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObjectObjectAssignsTableSeeder extends Seeder {
	
	public function run() {
	    DB::table('objectobjectassigns')->truncate();
	    DB::table('objectobjectassigns')->insert([
	        ['container_id'=>7,'element_id'=>5,'field'=>'father','index'=>0],
	        ['container_id'=>7,'element_id'=>6,'field'=>'mother','index'=>0],
	        ['container_id'=>8,'element_id'=>3,'field'=>'father','index'=>0],	        
	        ['container_id'=>8,'element_id'=>4,'field'=>'mother','index'=>0],
	        ['container_id'=>9,'element_id'=>3,'field'=>'father','index'=>0],
	        ['container_id'=>9,'element_id'=>4,'field'=>'mother','index'=>0],
	        
	        ['container_id'=>14,'element_id'=>10,'field'=>'part_of','index'=>0],
	        ['container_id'=>15,'element_id'=>10,'field'=>'part_of','index'=>0],
	        ['container_id'=>16,'element_id'=>11,'field'=>'part_of','index'=>0],
	        ['container_id'=>17,'element_id'=>11,'field'=>'part_of','index'=>0],
	        ['container_id'=>18,'element_id'=>12,'field'=>'part_of','index'=>0],
	        ['container_id'=>19,'element_id'=>12,'field'=>'part_of','index'=>0],
	        ['container_id'=>20,'element_id'=>13,'field'=>'part_of','index'=>0],
	        ['container_id'=>21,'element_id'=>14,'field'=>'part_of','index'=>0],
	        
	        ['container_id'=>22,'element_id'=>15,'field'=>'part_of','index'=>0],
	        ['container_id'=>23,'element_id'=>16,'field'=>'part_of','index'=>0],
	        ['container_id'=>24,'element_id'=>22,'field'=>'part_of','index'=>0],

	        ['container_id'=>5,'element_id'=>24,'field'=>'address','index'=>0],
	        ['container_id'=>6,'element_id'=>24,'field'=>'address','index'=>0],
	        ['container_id'=>7,'element_id'=>24,'field'=>'address','index'=>0],
	        ['container_id'=>8,'element_id'=>24,'field'=>'address','index'=>0],
	        ['container_id'=>9,'element_id'=>24,'field'=>'address','index'=>0],
	        
	        ['container_id'=>25,'element_id'=>5,'field'=>'persons','index'=>0],
	        
	        ['container_id'=>28,'element_id'=>24,'field'=>'location','index'=>0],
	        ['container_id'=>29,'element_id'=>24,'field'=>'location','index'=>0],
	        ['container_id'=>30,'element_id'=>24,'field'=>'location','index'=>0],
	        ['container_id'=>31,'element_id'=>24,'field'=>'location','index'=>0],
	        ['container_id'=>32,'element_id'=>24,'field'=>'location','index'=>0],
	        ['container_id'=>33,'element_id'=>24,'field'=>'location','index'=>0],
	        
	        ['container_id'=>28,'element_id'=>25,'field'=>'anniversary','index'=>0],
	        ['container_id'=>29,'element_id'=>25,'field'=>'anniversary','index'=>0],
	        ['container_id'=>30,'element_id'=>25,'field'=>'anniversary','index'=>0],
	        ['container_id'=>31,'element_id'=>26,'field'=>'anniversary','index'=>0],
	        ['container_id'=>32,'element_id'=>26,'field'=>'anniversary','index'=>0],
	        ['container_id'=>33,'element_id'=>26,'field'=>'anniversary','index'=>0],
	        
	    ]);
	}
}
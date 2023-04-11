<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationsTableSeeder extends Seeder {
	
	public function run() {
	    DB::table('locations')->truncate();
	    DB::table('locations')->insert([
	        ['id'=>10,'name'=>"U.S.A."],
	        ['id'=>11,'name'=>"Germany"],
	        ['id'=>12,'name'=>"France"],
	        ['id'=>13,'name'=>"Italy"],

	        ['id'=>14,'name'=>"New York"],
	        ['id'=>15,'name'=>"Springfield"],
	        ['id'=>16,'name'=>"Berlin"],
	        ['id'=>17,'name'=>"Hamburg"],
	        ['id'=>18,'name'=>"Paris"],
	        ['id'=>19,'name'=>"Orleans"],
	        ['id'=>20,'name'=>"Roma"],
	        ['id'=>21,'name'=>"Milano"],
	        
	        ['id'=>22,'name'=>"Evergreen Terrace"],
	        ['id'=>23,'name'=>"Unter den Linden"],

	        ['id'=>24,'name'=>"742 Evergreen Terrace"],
	        
	    ]);
	}
}
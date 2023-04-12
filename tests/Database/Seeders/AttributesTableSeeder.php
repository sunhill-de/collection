<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributesTableSeeder extends Seeder {
	
	public function run() {
	    DB::table('attributes')->truncate();
	    DB::table('attributes')->insert([
	        ['id'=>1,'name'=>'wikilink','type'=>'char','allowedobjects'=>"object",'property'=>''],
	        ['id'=>2,'name'=>'rating','type'=>'int','allowedobjects'=>"object",'property'=>''],
	    ]);
	}
}
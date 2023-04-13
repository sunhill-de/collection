<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreativeWorksTableSeeder extends Seeder {
	
	public function run() {
	    DB::table('creativeworks')->truncate();
	    DB::table('creativeworks')->insert([
	        ['id'=>42,'name'=>"The Fighter","release_date"=>"2010-12-06"],
	    ]);
	}
}
<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder {
	
	public function run() {
	    DB::table('countries')->truncate();
	    DB::table('countries')->insert([
	        ['id'=>10,'iso_code'=>"us"],
	        ['id'=>11,'iso_code'=>"de"],
	        ['id'=>12,'iso_code'=>"fr"],
	        ['id'=>13,'iso_code'=>"it"],
	    ]);
	}
}
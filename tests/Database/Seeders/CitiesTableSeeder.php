<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesTableSeeder extends Seeder {
	
	public function run() {
	    DB::table('cities')->truncate();
	    DB::table('cities')->insert([
	        ['id'=>14],
	        ['id'=>15],
	        ['id'=>16],
	        ['id'=>17],
	        ['id'=>18],
	        ['id'=>19],
	        ['id'=>20],
	        ['id'=>21],
	    ]);
	}
}
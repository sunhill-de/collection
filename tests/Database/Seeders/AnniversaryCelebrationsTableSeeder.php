<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnniversaryCelebrationsTableSeeder extends Seeder {
	
	public function run() {
	    DB::table('anniversarycelebrations')->truncate();
	    DB::table('anniversarycelebrations')->insert([
	        ['id'=>28],
	        ['id'=>29],
	        ['id'=>30],
	        ['id'=>31],
	        ['id'=>32],
	        ['id'=>33],
	    ]);
	}
}
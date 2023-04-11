<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StreetsTableSeeder extends Seeder {
	
	public function run() {
	    DB::table('streets')->truncate();
	    DB::table('streets')->insert([
	        ['id'=>22],
	        ['id'=>23],
	    ]);
	}
}
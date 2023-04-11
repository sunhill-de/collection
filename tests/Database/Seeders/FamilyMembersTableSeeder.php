<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FamilyMembersTableSeeder extends Seeder {
	
	public function run() {
	    DB::table('familymembers')->truncate();
	    DB::table('familymembers')->insert([
	        ['id'=>5],
	        ['id'=>6],
	        ['id'=>7],
	        ['id'=>8],
	        ['id'=>9],
	    ]);
	}
}
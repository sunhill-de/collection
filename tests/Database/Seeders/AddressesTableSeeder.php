<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressesTableSeeder extends Seeder {
	
	public function run() {
	    DB::table('addresses')->truncate();
	    DB::table('addresses')->insert([
	        ['id'=>24,'house_number'=>'742'],
	    ]);
	}
}
<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServersTableSeeder extends Seeder {
	
	public function run() {
	    DB::table('servers')->truncate();
	    DB::table('servers')->insert([
	        ['id'=>39,'description'=>'DHCP Server'],
	    ]);
	}
}
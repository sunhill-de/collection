<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertiesTableSeeder extends Seeder {
	
	public function run() {
	    DB::table('properties')->truncate();
	    DB::table('properties')->insert([
	        ['id'=>39,'name'=>'DHCP server','ingress_kind'=>'bought','type'=>'physical'],
	        ['id'=>40,'name'=>'Workstation office','ingress_king'=>'bought','type'=>'physical'],
	    ]);
	}
}
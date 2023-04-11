<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NetworkDevicesTableSeeder extends Seeder {
	
	public function run() {
	    DB::table('networkdevices')->truncate();
	    DB::table('networkdevices')->insert([
	        ['id'=>39,'mac_address'=>'49:a1:2c:f8:3f:e5','network_identifier'=>'server','pingable'=>1,'ip4_address'=>'192.168.100.1'],
	        ['id'=>40,'mac_address'=>'30:2d:89:aa:07:4a','network_identifier'=>'workstation','pingable'=>1,'ip4_address'=>'192.168.100.1'],
	    ]);
	}
}
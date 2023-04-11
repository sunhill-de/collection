<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ElectronicDevicesTableSeeder extends Seeder {
	
	public function run() {
	    DB::table('electronicdevices')->truncate();
	    DB::table('electronicdevices')->insert([
	        ['id'=>39,'power_supply'=>'plug','model_name'=>''],
	        ['id'=>40,'power_supply'=>'plug','model_name'=>''],
	    ]);
	}
}
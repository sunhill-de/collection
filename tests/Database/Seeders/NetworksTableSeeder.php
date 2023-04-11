<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NetworksTableSeeder extends Seeder {
	
	public function run() {
	    DB::table('networks')->truncate();
	    DB::table('networks')->insert([
	        ['id'=>34,'name'=>'Internal','prefix'=>'192.168.100','description'=>'Internal network'],	        
	        ['id'=>35,'name'=>'DMZ','prefix'=>'192.168.101','DMZ network'],
	    ]);
	}
}
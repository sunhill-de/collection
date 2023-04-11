<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganisationsTableSeeder extends Seeder {
	
	public function run() {
	    DB::table('organisations')->truncate();
	    DB::table('organisations')->insert([	        
	        ['id'=>41,'name'=>"Amazon"],	        
	    ]);
	}
}
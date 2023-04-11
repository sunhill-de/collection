<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopsTableSeeder extends Seeder {
	
	public function run() {
	    DB::table('shops')->truncate();
	    DB::table('shops')->insert([	        
	        ['id'=>41,'kind'=>"online"],	        
	    ]);
	}
}
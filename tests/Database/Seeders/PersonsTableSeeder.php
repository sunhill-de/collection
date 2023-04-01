<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonsTableSeeder extends Seeder {
	
	public function run() {
	    DB::table('persons')->truncate();
	    DB::table('persons')->insert([
	        ['id'=>1,'firstname'=>"Stephen","lastname"=>"King","sex"=>"male"],
	    ]);
	}
}
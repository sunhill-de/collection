<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonsTableSeeder extends Seeder {
	
	public function run() {
	    DB::table('persons')->truncate();
	    DB::table('persons')->insert([
	        ['id'=>1,'firstname'=>"Stephen","lastname"=>"King","sex"=>"male"],
	        ['id'=>2,'firstname'=>"David","lastname"=>"Fincher","sex"=>"male"],
	        ['id'=>3,'firstname'=>"Bruce","lastname"=>"Springsteen","sex"=>"male"],
	        ['id'=>4,'firstname'=>"Tanya","lastname"=>"Donelly","sex"=>"female"],	    
	        ['id'=>5,'firstname'=>"Homer","lastname"=>"Simpson","sex"=>"male"],
	        ['id'=>6,'firstname'=>"Marge","lastname"=>"Simpson","sex"=>"female"],
	        ['id'=>7,'firstname'=>"Bart","lastname"=>"Simpson","sex"=>"male"],
	        ['id'=>8,'firstname'=>"Lisa","lastname"=>"Simpson","sex"=>"female"],
	        ['id'=>9,'firstname'=>"Maggie","lastname"=>"Simpson","sex"=>"female"],
	    ]);
	}
}
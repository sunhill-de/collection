<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FriendsTableSeeder extends Seeder {
	
	public function run() {
	    DB::table('friends')->truncate();
	    DB::table('friends')->insert([
	        ['id'=>5,'date_of_birth'=>"1956-05-12","birth_name"=>null],
	        ['id'=>6,"date_of_birth"=>null,"birth_name"=>"Bouvier"],
	        ['id'=>7,"date_of_birth"=>"1980-02-23","birth_name"=>null],
	        ['id'=>8,"date_of_birth"=>"1981-05-09","birth_name"=>null],
	        ['id'=>9,"date_of_birth"=>null,"birth_name"=>null],
	    ]);
	}
}
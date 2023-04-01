<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObjectsTableSeeder extends Seeder {
	
	public function run() {
	    DB::table('objects')->truncate();
	    DB::table('objects')->insert([
	        ['id'=>1,'classname'=>"Person",'uuid'=>'a123','created_at'=>'2023-04-01 00:55:00'],
	    ]);
	}
}
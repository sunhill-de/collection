<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatesTableSeeder extends Seeder {
	
	public function run() {
	    DB::table('dates')->truncate();
	    DB::table('dates')->insert([
	        ['id'=>28,'name'=>'7th birthday Bart','begin_date'=>'1987-02-23'],
	        ['id'=>29,'name'=>'8th birthday Bart','begin_date'=>'1988-02-23'],
	        ['id'=>30,'name'=>'9th birthday Lisa','begin_date'=>'1989-02-23'],
	        ['id'=>31,'name'=>'6th birthday Lisa','begin_date'=>'1987-05-09'],
	        ['id'=>32,'name'=>'7th birthday Lisa','begin_date'=>'1988-05-09'],
	        ['id'=>33,'name'=>'8th birthday Lisa','begin_date'=>'1989-05-09'],
	    ]);
	}
}
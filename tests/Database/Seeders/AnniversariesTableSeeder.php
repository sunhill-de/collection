<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnniversariesTableSeeder extends Seeder {
	
	public function run() {
	    DB::table('anniversaries')->truncate();
	    DB::table('anniversaries')->insert([
	        ['id'=>25,'name'=>'Geburtstag Homer','first'=>'1956-05-12','type'=>'birthday'],
	        ['id'=>26,'name'=>'Geburtstag Bart','first'=>'1980-02-23','type'=>'birthday'],
	        ['id'=>27,'name'=>'Geburtstag Lisa','first'=>'1981-05-09','type'=>'birthday'],
	    ]);
	}
}
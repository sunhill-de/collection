<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VisualWorksTableSeeder extends Seeder {
	
	public function run() {
	    DB::table('visualworks')->truncate();
	    DB::table('visualworks')->insert([
	        ['id'=>42,'type'=>"movie"],
	    ]);
	}
}
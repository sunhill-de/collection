<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieImportsTableSeeder extends Seeder {
	
	public function run() {
	    DB::table('import_movies')->truncate();
	    DB::table('import_movies')->insert([
	        ['id'=>1,'title'=>'After.Life','source'=>'videobuster','source_id'=>'04.11.2022','imdb_id'=>null,'object_id'=>0],
	        ['id'=>2,'title'=>'Babylon A.D.','source'=>'videobuster','source_id'=>'24.11.2022','imdb_id'=>'tt1043844','object_id'=>0],
	        ['id'=>3,'title'=>'The Fighter','source'=>'videobuster','source_id'=>'28.10.2022','imdb_id'=>'tt0964517','object_id'=>42],
	    ]);
	}
}
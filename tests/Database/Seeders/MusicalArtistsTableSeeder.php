<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MusicalArtistsTableSeeder extends Seeder {
	
	public function run() {
	    DB::table('musicalartists')->truncate();
	    DB::table('musicalartists')->insert([
	        ['id'=>36,'name'=>'Throwing Muses','sort_name'=>'Throwing Muses','type'=>'group','gender'=>'none'],	        	        
	        ['id'=>37,'name'=>'Bruce Springsteen','sort_name'=>'Springsteen, Bruce','type'=>'person','gender'=>'male'],
	        ['id'=>38,'name'=>'Muse','sort_name'=>'Throwing Muses','type'=>'group','gender'=>'none'],
	    ]);
	}
}
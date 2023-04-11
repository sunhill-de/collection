<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComputersTableSeeder extends Seeder {
	
	public function run() {
	    DB::table('computers')->truncate();
	    DB::table('computers')->insert([
	        ['id'=>39,'computer_type'=>'server','operating_system'=>'Debian'],
	        ['id'=>40,'computer_type'=>'standalone','operating_system'=>'Gentoo'],
	    ]);
	}
}
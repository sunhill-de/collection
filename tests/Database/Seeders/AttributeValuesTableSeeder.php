<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeValuesTableSeeder extends Seeder {
	
	public function run() {
	    DB::table('attributevalues')->truncate();
	    DB::table('attributevalues')->insert([
	        ['attribute_id'=>1,'object_id'=>1,'value'=>'https://en.wikipedia.org/wiki/Stephen_King','textvalue'=>''],
	        ['attribute_id'=>1,'object_id'=>2,'value'=>'https://en.wikipedia.org/wiki/David_Fincher','textvalue'=>''],
	        ['attribute_id'=>1,'object_id'=>3,'value'=>'https://en.wikipedia.org/wiki/Bruce_Springsteen','textvalue'=>''],
	        ['attribute_id'=>1,'object_id'=>4,'value'=>'https://en.wikipedia.org/wiki/Tanya_Donelly','textvalue'=>''],
	        ['attribute_id'=>1,'object_id'=>5,'value'=>'https://en.wikipedia.org/wiki/Homer_Simpson','textvalue'=>''],
	    ]);
	}
}
<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObjectsTableSeeder extends Seeder {
	
	public function run() {
	    DB::table('objects')->truncate();
	    DB::table('objects')->insert([
	        ['id'=>1,'classname'=>"Person",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50000','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>2,'classname'=>"Person",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50001','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>3,'classname'=>"Person",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50002','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>4,'classname'=>"Person",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50003','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>5,'classname'=>"FamilyMember",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50004','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>6,'classname'=>"FamilyMember",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50005','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>7,'classname'=>"FamilyMember",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50006','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>8,'classname'=>"FamilyMember",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50007','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>9,'classname'=>"FamilyMember",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50008','created_at'=>'2023-04-01 00:55:00'],
	    
	        ['id'=>10,'classname'=>"Country",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50009','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>11,'classname'=>"Country",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50010','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>12,'classname'=>"Country",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50011','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>13,'classname'=>"Country",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50012','created_at'=>'2023-04-01 00:55:00'],	    
	        ['id'=>14,'classname'=>"City",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50013','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>15,'classname'=>"City",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50014','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>16,'classname'=>"City",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50015','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>17,'classname'=>"City",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50016','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>18,'classname'=>"City",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50017','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>19,'classname'=>"City",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50018','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>20,'classname'=>"City",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50019','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>21,'classname'=>"City",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50020','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>22,'classname'=>"Street",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50021','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>23,'classname'=>"Street",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50022','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>24,'classname'=>"Address",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50023','created_at'=>'2023-04-01 00:55:00'],

	        ['id'=>25,'classname'=>"Anniversary",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50024','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>26,'classname'=>"Anniversary",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50025','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>27,'classname'=>"Anniversary",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50026','created_at'=>'2023-04-01 00:55:00'],
	        
	        ['id'=>28,'classname'=>"AnniversaryCelebration",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50027','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>29,'classname'=>"AnniversaryCelebration",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50028','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>30,'classname'=>"AnniversaryCelebration",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50029','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>31,'classname'=>"AnniversaryCelebration",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50030','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>32,'classname'=>"AnniversaryCelebration",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50031','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>33,'classname'=>"AnniversaryCelebration",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50032','created_at'=>'2023-04-01 00:55:00'],

	        ['id'=>34,'classname'=>"Network",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50033','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>35,'classname'=>"Network",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50034','created_at'=>'2023-04-01 00:55:00'],
	        
	        ['id'=>36,'classname'=>"MusicalArtist",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50035','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>37,'classname'=>"MusicalArtist",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50036','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>38,'classname'=>"MusicalArtist",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50037','created_at'=>'2023-04-01 00:55:00'],

	        ['id'=>39,'classname'=>"Server",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50038','created_at'=>'2023-04-01 00:55:00'],
	        ['id'=>40,'classname'=>"Computer",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50039','created_at'=>'2023-04-01 00:55:00'],
	        
	        ['id'=>41,'classname'=>"Shop",'uuid'=>'8ad8ccfb-ecc8-4125-89c7-a9c92ac50040','created_at'=>'2023-04-01 00:55:00'],
	        
	    ]);
	}
}
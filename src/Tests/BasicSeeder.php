<?php

namespace Sunhill\Collection\Tests;

use Sunhill\Collection\Collections\Language;

use Sunhill\Collection\Collections\Genre;
use Sunhill\Collection\Collections\EventType;

use Sunhill\Collection\Objects\Creative\Movie;
use Sunhill\Collection\Objects\Locations\Country;
use Sunhill\Collection\Objects\Creative\TVSeries;
use Sunhill\Collection\Objects\Locations\City;
use Sunhill\Collection\Objects\Locations\Street;
use Sunhill\Collection\Objects\Locations\Address;
use Sunhill\Collection\Collections\ProductGroup;

use Sunhill\Collection\Objects\Persons\Person;
use Sunhill\Collection\Objects\Persons\FamilyMember;

use Sunhill\Collection\Collections\PersonsRelation;
use Sunhill\Collection\Collections\Staff;
use Sunhill\Collection\Collections\StaffJob;
use Sunhill\Collection\Collections\Anniversary;
use Sunhill\Collection\Collections\Event;
use Sunhill\Collection\Collections\Network;
use Sunhill\Collection\Objects\Persons\Friend;
use Sunhill\Collection\Objects\Locations\Floor;
use Sunhill\Collection\Objects\Locations\Room;
use Sunhill\Collection\Collections\MusicalArtist;
use Sunhill\Collection\Objects\Creative\MovieSeries;
use Sunhill\Collection\Objects\Creative\Episode;
use Sunhill\Collection\Objects\Creative\Clip;
use Sunhill\Collection\Objects\Organisations\Shop;
use Sunhill\Collection\Objects\Organisations\Manufacturer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Sunhill\ORM\Objects\ORMObject;
use Illuminate\Support\Facades\Artisan;

class BasicSeeder
{
    
    protected function seedTags()
    {
        DB::table('tags')->truncate();
        DB::table('tags')->insert([
            ['id'=>1,'name'=>'Family','options'=>0,'parent_id'=>null],
            ['id'=>2,'name'=>'Homer','options'=>0,'parent_id'=>1],
            ['id'=>3,'name'=>'Marge','options'=>0,'parent_id'=>1],
            ['id'=>4,'name'=>'Bart','options'=>0,'parent_id'=>1],
            ['id'=>5,'name'=>'Lisa','options'=>0,'parent_id'=>1],
            ['id'=>6,'name'=>'Maggie','options'=>0,'parent_id'=>1],
            ['id'=>7,'name'=>'Springfield','options'=>0,'parent_id'=>0],
            ['id'=>8,'name'=>'ElementarySchool','options'=>0,'parent_id'=>7],
            ['id'=>9,'name'=>'PowerPlant','options'=>0,'parent_id'=>7],
            ['id'=>10,'name'=>"MoesTavern",'options'=>0,'parent_id'=>7],
            ['id'=>11,'name'=>"QuickEMart",'options'=>0,'parent_id'=>7],
            ['id'=>12,'name'=>"Hospital",'options'=>0,'parent_id'=>7],
            ['id'=>13,'name'=>"Church",'options'=>0,'parent_id'=>7],
        ]);
        DB::table('tagcache')->truncate();
        DB::table('tagcache')->insert([
            ['path_name'=>'Family','tag_id'=>1,'is_fullpath'=>1],
            ['path_name'=>'Family.Homer','tag_id'=>2,'is_fullpath'=>1],
            ['path_name'=>'Homer','tag_id'=>2,'is_fullpath'=>0],
            ['path_name'=>'Family.Marge','tag_id'=>3,'is_fullpath'=>1],
            ['path_name'=>'Marge','tag_id'=>3,'is_fullpath'=>0],
            ['path_name'=>'Family.Bart','tag_id'=>4,'is_fullpath'=>1],
            ['path_name'=>'Bart','tag_id'=>4,'is_fullpath'=>0],
            ['path_name'=>'Family.Lisa','tag_id'=>5,'is_fullpath'=>1],
            ['path_name'=>'Lisa','tag_id'=>5,'is_fullpath'=>0],
            ['path_name'=>'Family.Maggie','tag_id'=>6,'is_fullpath'=>1],
            ['path_name'=>'Maggie','tag_id'=>6,'is_fullpath'=>0],
            ['path_name'=>'Springfield','tag_id'=>7,'is_fullpath'=>1],
            ['path_name'=>'ElementarySchool','tag_id'=>8,'is_fullpath'=>0],
            ['path_name'=>'Springfield.ElementarySchool','tag_id'=>8,'is_fullpath'=>1],
            ['path_name'=>'PowerPlant','tag_id'=>9,'is_fullpath'=>0],
            ['path_name'=>'Springfield.PowerPlant','tag_id'=>9,'is_fullpath'=>1],
            ['path_name'=>'MoesTavern','tag_id'=>10,'is_fullpath'=>0],
            ['path_name'=>'Springfield.MoesTavern','tag_id'=>10,'is_fullpath'=>1],
            ['path_name'=>'QuickEMart','tag_id'=>10,'is_fullpath'=>0],
            ['path_name'=>'Springfield.QuickEMart','tag_id'=>10,'is_fullpath'=>1],
            ['path_name'=>'Hospital','tag_id'=>10,'is_fullpath'=>0],
            ['path_name'=>'Springfield.Hospital','tag_id'=>10,'is_fullpath'=>1],
            ['path_name'=>'Church','tag_id'=>10,'is_fullpath'=>0],
            ['path_name'=>'Springfield.Church','tag_id'=>10,'is_fullpath'=>1],
            
        ]);
        DB::table('tagobjectassigns')->truncate();
        DB::table('tagobjectassigns')->insert([
            ['container_id'=>ORMObject::getSeedID('homer'),'tag_id'=>2],
            ['container_id'=>ORMObject::getSeedID('marge'),'tag_id'=>3],
            ['container_id'=>ORMObject::getSeedID('bart'),'tag_id'=>4],
            ['container_id'=>ORMObject::getSeedID('lisa'),'tag_id'=>5],
            ['container_id'=>ORMObject::getSeedID('maggie'),'tag_id'=>6],
        ]);
    }
    
    protected function seedAttributes()
    {
        DB::table('attributes')->truncate();
        DB::table('attributes')->insert([
            ['id'=>1,'name'=>'wikipedia','type'=>'string','allowed_classes'=>'|CreativeWork|Person|Organisation|'],
            ['id'=>2,'name'=>'rating','type'=>'integer','allowed_classes'=>'|CreativeWork|'],
            ['id'=>3,'name'=>'test','type'=>'integer','allowed_classes'=>'|Person|'],
            ['id'=>4,'name'=>'height','type'=>'float','allowed_classes'=>'|Person|'],
            ['id'=>5,'name'=>'weight','type'=>'float','allowed_classes'=>'|Person|'],
            ['id'=>6,'name'=>'IQ','type'=>'integer','allowed_classes'=>'|Person|'],
            ['id'=>7,'name'=>'consumed','type'=>'integer','allowed_classes'=>'|CreativeWork|'],
            ['id'=>8,'name'=>'color','type'=>'string','allowed_classes'=>'|Property|'],
            ['id'=>9,'name'=>'temperature','type'=>'float','allowed_classes'=>'|Property|'],
            ['id'=>10,'name'=>'surface','type'=>'string','allowed_classes'=>'|Property|'],
            ['id'=>11,'name'=>'smells','type'=>'integer','allowed_classes'=>'|Property|'],
            ['id'=>12,'name'=>'completed','type'=>'integer','allowed_classes'=>'|CreativeWork|'],
            ['id'=>13,'name'=>'something','type'=>'integer','allowed_classes'=>'|Organisation|'],
            ['id'=>14,'name'=>'else','type'=>'integer','allowed_classes'=>'|Person|'],
            ['id'=>15,'name'=>'hair','type'=>'integer','allowed_classes'=>'|Person|'],
        ]);
        Schema::create('attr_wikipedia', function($table) {
            $table->integer('object_id')->primary();
            $table->string('value');
        });
        Schema::create('attr_rating', function($table) {
            $table->integer('object_id')->primary();
            $table->integer('value');
        });
        DB::table('attr_wikipedia')->insert([
                    ['object_id'=>ORMObject::getSeedID('homer'),
                        'value'=>'http://de.wikipedia.org/wiki/Homer_Simpson'],
                    ['object_id'=>ORMObject::getSeedID('marge'),
                        'value'=>'http://de.wikipedia.org/wiki/Marge_Simpson'],
        ]);
    }
    
    protected function seedFilters()
    {
        DB::table('listfilters')->insert(
            [[
                'id'=>1,
                'bestbefore'=>'2023-09-09 12:00:00',
                'name'=>'',
                'name_id'=>'8b1a9953c4',
                'list'=>'tags',
            ],
            [
                'id'=>2,
                'bestbefore'=>null,
                'name'=>'Test Tag Filter',
                'name_id'=>'f8c47804d7',
                'list'=>'tags'
            ],
            [
                'id'=>3,
                'bestbefore'=>'2923-09-09 12:00:00',
                'name'=>'',
                'name_id'=>'611296a827',
                'list'=>'tags',
            ]],
            );
        DB::table('listfilterconditions')->insert(
            [
                [
                    'id'=>1,
                    'listfilter_id'=>1,
                    'connection'=>'',
                    'field'=>'name',
                    'relation'=>'<',
                    'condition'=>'S'
                ],
                [
                    'id'=>2,
                    'listfilter_id'=>2,
                    'connection'=>'',
                    'field'=>'name',
                    'relation'=>'>',
                    'condition'=>'D'
                ],
                [
                    'id'=>3,
                    'listfilter_id'=>3,
                    'connection'=>'',
                    'field'=>'name',
                    'relation'=>'<',
                    'condition'=>'S'
                ],
                [
                    'id'=>4,
                    'listfilter_id'=>3,
                    'connection'=>'',
                    'field'=>'name',
                    'relation'=>'>',
                    'condition'=>'D'                    
                ]
            ]
        );
    }
    
    protected function seedProductGroups()
    {
        ProductGroup::seed(['food'=>['name'=>'food']]);
        ProductGroup::seed(['nonfood'=>['name'=>'nonfood']]);
        ProductGroup::seed(['electronics'=>['name'=>'electronics','part_of'=>ProductGroup::getSeedID('nonfood')]]);
        ProductGroup::seed(['computer'=>['name'=>'computer', 'part_of'=>ProductGroup::getSeedID('electronics')]]);
        ProductGroup::seed(['beer'=>['name'=>'beer','part_of'=>ProductGroup::getSeedID('food')]]);
    }
    
    protected function seedMusicalArtists()
    {
        MusicalArtist::seed([
            'muse'=>['name'=>'Muse','sort_name'=>'MUSE','type'=>'group','gender'=>'none'],
            'maiden'=>['name'=>'Iron Maiden','sort_name'=>'IRON MAIDEN','type'=>'group','gender'=>'none'],
            ['name'=>'The Vaccines','sort_name'=>'VACCINES, THE','type'=>'group','gender'=>'none'],
            ['name'=>'Bruce Springsteen','sort_name'=>'SPRINGESTEEN, BRUCE','type'=>'person','gender'=>'male'],
            ['name'=>'Muzzle','sort_name'=>'MUZZLE','type'=>'group','gender'=>'none'],
            ['name'=>'Led Zeppling','sort_name'=>'LEDZEPPLIN','type'=>'group','gender'=>'none'],
            ['name'=>'Die Ärzte','sort_name'=>'ARZTE, DIE','type'=>'group','gender'=>'none'],
            ['name'=>'Devin Townsend','sort_name'=>'TOWNSEND, DEVIN','type'=>'person','gender'=>'male'],
            ['name'=>'Doves','sort_name'=>'DOVES','type'=>'group','gender'=>'none'],
            ['name'=>'The Beach Boys','sort_name'=>'BEACHBOYS, THE','type'=>'group','gender'=>'none'],
            ['name'=>'Blondie','sort_name'=>'BLONDIE','type'=>'group','gender'=>'none'],
            ['name'=>'The Who','sort_name'=>'WHO, THE','type'=>'group','gender'=>'none'],
            ['name'=>'Rush','sort_name'=>'RUSH','type'=>'group','gender'=>'none'],
            ['name'=>'U2','sort_name'=>'U2','type'=>'group','gender'=>'none'],
            ['name'=>'Lou Reed','sort_name'=>'Reed, Lou','type'=>'person','gender'=>'male'],
            ['name'=>'Angels & Airwaves','sort_name'=>'ANGELSAIRWAVES','type'=>'group','gender'=>'none'],
            ['name'=>'Drugstore','sort_name'=>'Drugstore','type'=>'group','gender'=>'none'],
            ['name'=>"Guns N' Roses",'sort_name'=>'GUNSROSES','type'=>'group','gender'=>'none'],
            ['name'=>'Ash','sort_name'=>'Ash','type'=>'group','gender'=>'none'],
            ['name'=>'R.E.M.','sort_name'=>'REM','type'=>'group','gender'=>'none'],
        ]);
    }
    
    protected function seedPersons()
    {
        Person::seed([
            'norton'=>['firstname'=>'Edward','lastname'=>'Norton','sex'=>'male','groups'=>['actor']],
            'pitt'=>['firstname'=>'Brad','lastname'=>'Pitt','sex'=>'male','groups'=>['actor']],
            'carter'=>['firstname'=>'Helena','lastname'=>'Bonham Carter','sex'=>'female','groups'=>['actor']],
            'fincher'=>['firstname'=>'David','lastname'=>'Fincher','sex'=>'male','groups'=>['director']]
        ]);
    }
    
    protected function seedFriends()
    {
        Friend::seed([
            'carl'=>['firstname'=>'Carl','lastname'=>'Carlson','sex'=>'male','groups'=>['plant','bar'],'date_of_birth'=>'1960-12-12'],
            ['firstname'=>'Lenny','lastname'=>'Leonard','sex'=>'male','groups'=>['plant','bar'],'date_of_birth'=>'1962-08-12'],
            ['firstname'=>'Barney','lastname'=>'Gumble','sex'=>'male','groups'=>['bar'],'date_of_birth'=>'1962-01-08'],
            ['firstname'=>'Moe', 'lastname'=>'Szyslak','sex'=>'male','groups'=>['bar']],
            ['firstname'=>'Edna', 'lastname'=>'Krabappel','sex'=>'female','groups'=>['school']],
        ]);
    }
    
    protected function seedCountries()
    {
        Country::seed([
            'germany'=>['name'=>'germany','iso_code'=>'DE'],
            'france'=>['name'=>'france','iso_code'=>'FR'],
            'spain'=>['name'=>'spain','iso_code'=>'ES'],
            'usa'=>['name'=>'U.S.A.','iso_code'=>'US'],
            'gb'=>['name'=>'Great Britain','iso_code'=>'UK'],
            'poland'=>['name'=>'poland','iso_code'=>'PL'],
        ]);
    }
    
    protected function seedCities()
    {
        City::seed([
            'springfield'=>['name'=>'Springfield','part_of'=>City::getSeedID('usa')],
            'berlin'=>['name'=>'Berlin','part_of'=>City::getSeedID('germany')],
            'madrid'=>['name'=>'Madrid','part_of'=>City::getSeedID('spain')],
            'paris'=>['name'=>'Paris','part_of'=>City::getSeedID('france')],
            'washington'=>['name'=>'Washington D.C.','part_of'=>City::getSeedID('usa')],
            'london'=>['name'=>'London','part_of'=>City::getSeedID('gb')],
        ]);
    }
    
    protected function postSeedCountries()
    {
        Country::postSeed([
            Country::getSeedID('germany')=>['capital'=>Country::getSeedID('berlin')],
            Country::getSeedID('france')=>['capital'=>Country::getSeedID('paris')],
            Country::getSeedID('usa')=>['capital'=>Country::getSeedID('washington')],
            Country::getSeedID('spain')=>['capital'=>Country::getSeedID('madrid')],
            Country::getSeedID('gb')=>['capital'=>Country::getSeedID('london')],
        ]);
    }
    
    protected function seedStreets()
    {
        Street::seed([
            'evergreen'=>['name'=>'Evergreen Terrace','part_of'=>Street::getSeedID('springfield')],
            'kudamm'=>['name'=>'Kufürstendamm', 'part_of'=>Street::getSeedID('berlin')],
        ]);
    }
    
    protected function seedAddresses()
    {
        Address::seed(['simpsons'=>['name'=>'742 Evergreen Terrace','house_number'=>'742','part_of'=>Street::getSeedID('evergreen')]]);
        FamilyMember::postSeed([
            FamilyMember::getSeedID('homer')=>['address'=>Address::getSeedID('simpsons')],
            FamilyMember::getSeedID('marge')=>['address'=>Address::getSeedID('simpsons')],
            FamilyMember::getSeedID('bart')=>['address'=>Address::getSeedID('simpsons')],
            FamilyMember::getSeedID('lisa')=>['address'=>Address::getSeedID('simpsons')],
            FamilyMember::getSeedID('maggie')=>['address'=>Address::getSeedID('simpsons')],
        ]);
    }
    
    protected function seedFloors()
    {
        Floor::seed([
            'cellar'=>['name'=>'Cellar', 'level'=>-1, 'part_of'=>Floor::getSeedID('simpsons')],
            'ground'=>['name'=>'Ground floor', 'level'=>0, 'part_of'=>Floor::getSeedID('simpsons')],
            'upstairs'=>['name'=>'Upstairs', 'level'=>1, 'part_of'=>Floor::getSeedID('simpsons')],
            'attic'=>['name'=>'Attic', 'level'=>2, 'part_of'=>Floor::getSeedID('simpsons')],
        ]);
    }
    
    protected function seedRooms()
    {
        Room::seed([
            'kitchen'=>['name'=>'Kitchen','inside'=>1,'type'=>'kitchen','part_of'=>Room::getSeedID('ground')],
            'living'=>['name'=>'Living room','inside'=>1,'type'=>'living','part_of'=>Room::getSeedID('ground')],
            'dining'=>['name'=>'Dining room','inside'=>1,'type'=>'dining','part_of'=>Room::getSeedID('ground')],
            
            'barts'=>['name'=>"Bart's room",'inside'=>1,'type'=>'sleep','part_of'=>Room::getSeedID('upstairs')],
            'lisas'=>['name'=>"Lisa's room",'inside'=>1,'type'=>'sleep','part_of'=>Room::getSeedID('upstairs')],
            'maggies'=>['name'=>"Maggie's room",'inside'=>1,'type'=>'sleep','part_of'=>Room::getSeedID('upstairs')],
            'bedroom'=>['name'=>"Bedroom",'inside'=>1,'type'=>'sleep','part_of'=>Room::getSeedID('upstairs')],
        ]);
    }

    protected function seedPseudoLocations()
    {
    }
    
    protected function seedLanguages()
    {
        Language::seed([
            'english'=>['name'=>'english','iso'=>'en'],
            'german'=>['name'=>'german','iso'=>'de'],
            'french'=>['name'=>'french','iso'=>'fr'],
            'spanish'=>['name'=>'spanish','iso'=>'es'],
        ]);
    }
    
    protected function seedTVSeries()
    {
        TVSeries::seed(
            [
                'lost'=>[
                    'name'=>'Lost',
                    'original_name'=>'Lost',
                    'sort_name'=>'LOST',
                    'item_count'=>121,
                    'imdb_id'=>'tt411008',
                    'tmdb_id'=>'/tv/4609-lost',
                    'number_of_episodes'=>121,
                    'number_of_seasons'=>6
                ],
                'sons'=>[
                    'name'=>'Sons of Anarchy',
                    'original_name'=>'Sons of Anarchy',
                    'sort_name'=>'SONSOFANARCHY',
                    'item_count'=>92,
                    'imdb_id'=>'tt1124373',
                    'tmdb_id'=>'/tv/1409-sons-of-anarchy',
                    'number_of_episodes'=>92,
                    'number_of_seasons'=>7
                ],
                'from'=>[
                    'name'=>'From',
                    'original_name'=>'From',
                    'sort_name'=>'From',
                    'item_count'=>20,
                    'number_of_episodes'=>20,
                    'number_of_seasons'=>2
                ]
            ]);
        
    }
    
    protected function seedStaffJobs()
    {
        StaffJob::seed([
            'actor'=>['name'=>'actor'],
            'director'=>['name'=>'director'],
            'guitar'=>['name'=>'lead guitar'],
            'bass'=>['name'=>'bass guitar'],
            'drums'=>['name'=>'drums']
        ]);
    }
    
    protected function seedStaff()
    {
        Staff::seed([
            'narrator'=>[
                'person'=>Staff::getSeedID('norton'),
                'job'=>Staff::getSeedID('actor'),
                'additional'=>'Narrator'
            ],
            'durden'=>[
                'person'=>Staff::getSeedID('pitt'),
                'job'=>Staff::getSeedID('actor'),
                'additional'=>'Tyler Durden'
            ],
            'singer'=>[
                'person'=>Staff::getSeedID('carter'),
                'job'=>Staff::getSeedID('actor'),
                'additional'=>'Marla Singer'
            ],
            'dir_fincher'=>[
                'person'=>Staff::getSeedID('fincher'),
                'job'=>Staff::getSeedID('director'),
            ],
        ]);
    }
    
    protected function seedMovies()
    {
        Movie::seed(
            [
                'fightclub'=>[
                    'name'=>'Fight Club',
                    'original_name'=>'Fight Club',
                    'sort_name'=>'FIGHTCLUB',
                    'release_date'=>'1999-11-11',
                    'language'=>Movie::getSeedID('english'),
                    'countries'=>[Movie::getSeedID('usa')],
                    'length'=>139,
                    'imdb_id'=>'tt0137523',
                    'tmdb_id'=>'/movie/550-fight-club',
                    'keywords'=>['fight','anarchy'],
                    'staff'=>[Movie::getSeedID('narrator'),Movie::getSeedID('durden'),Movie::getSeedID('singer'),Movie::getSeedID('dir_fincher')]
                ],
                [
                    'name'=>'Die Stadt der verlorenen Kinder',
                    'original_name'=>'La Cité des Enfants Perdus',
                    'sort_name'=>'STADTDERVERLORENENKINDER, DIE',
                    'release_date'=>'1995-08-17',
                    'language'=>Movie::getSeedID('french'),
                    'countries'=>[Movie::getSeedID('france')],
                    'length'=>112,
                    'imdb_id'=>'tt0112682',
                    'tmdb_id'=>'/movie/902-la-cite-des-enfants-perdus',
                    'keywords'=>['dystopia', 'steampunk']
                ],
            ]);
        
    }
    
    protected function seedMovieSeries()
    {
        MovieSeries::seed([
            'diehard'=>[
                'name'=>'Stirb langsam',
                'original_name'=>'Die hard',
                'sort_name'=>'STIRBLANGSAM',
                'item_count'=>5,
            ],
            'rambo'=>[
                'name'=>'Rambo',
                'original_name'=>'Rambo',
                'sort_name'=>'RAMBO',
                'item_count'=>5,
            ],
            'alien'=>[
                'name'=>'Alien',
                'original_name'=>'Alien',
                'sort_name'=>'ALIEN',
                'item_count'=>6,
            ]
        ]);
    }
    
    protected function seedEpisodes()
    {
        Episode::seed([
            'constant'=>[
                'name'=>'Die Konstante',
                'original_name'=>'The constant',
                'sort_name'=>'KONSTANTE, DIE',
                'series'=>Episode::getSeedID('lost'),
                'season'=>4,
                'episode'=>5,
                'length'=>44,
                'release_date'=>'2008-02-27'
            ],
            [
                'name'=>'Hüttenzauber',
                'original_name'=>'Cabin Fever',
                'sort_name'=>'HUTTENZAUBER',
                'series'=>Episode::getSeedID('lost'),
                'season'=>4,
                'episode'=>11,
                'length'=>44,
                'release_date'=>'2008-05-08'
            ],
            [
                'name'=>'Alle Guten Dinge',
                'original_name'=>'All Good Things',
                'sort_name'=>'ALLEGUTENDINGE',
                'series'=>Episode::getSeedID('from'),
                'season'=>1,
                'episode'=>7,
                'length'=>60,
                'release_date'=>'2022-03-20'
            ],
        ]);
    }
    
    protected function seedEventTypes()
    {
        EventType::seed([
            'watch'=>['name'=>'watch'],
            'change'=>['name'=>'change'],
            'switch'=>['name'=>'switch']
        ]);
    }
    
    protected function seedGenres()
    {
        Genre::seed([
            'fiction'=>[
                'name'=>'fiction',
                'media_type'=>['VisualWork','WrittenWork'],
            ],
            'nonfiction'=>[
                'name'=>'nonfiction',
                'media_type'=>['VisualWork','WrittenWork'],
            ]
        ]);
        
        Genre::seed([
            [
                'name'=>'science fiction',
                'media_type'=>['VisualWork','WrittenWork'],
                'parent'=>Movie::getSeedID('fiction')
            ],
            [
                'name'=>'drama',
                'media_type'=>['VisualWork','WrittenWork'],
                'parent'=>Movie::getSeedID('fiction')
            ],
            [
                'name'=>'horror',
                'media_type'=>['VisualWork','WrittenWork'],
                'parent'=>Movie::getSeedID('fiction')
            ],
            [
                'name'=>'computer',
                'media_type'=>['WrittenWork'],
                'parent'=>Movie::getSeedID('nonfiction')
            ],
            [
                'name'=>'programming',
                'media_type'=>['VisualWork','WrittenWork'],
                'parent'=>Movie::getSeedID('nonfiction')
            ],
        ]);
        
    }
    
    protected function seedFamilyMembers()
    {
        FamilyMember::seed([
            'homer'=>[
                'firstname'=>'Homer',
                'middlename'=>'Jay',
                'lastname'=>'Simpson',
                'sex'=>'male',
                'date_of_birth'=>"1956-05-12"
            ],
            'marge'=>[
                'firstname'=>'Marge',
                'lastname'=>'Simpson',
                'sex'=>'female',
                "birth_name"=>"Bouvier"
            ]
        ]);
        FamilyMember::seed([
            'bart'=>[
                'firstname'=>"Bart",
                "lastname"=>"Simpson",
                "sex"=>"male",
                "date_of_birth"=>"1980-02-23",
                'father'=>FamilyMember::getSeedID('homer'),
                'mother'=>FamilyMember::getSeedID('marge')
            ],
            'lisa'=>[
                'firstname'=>"Lisa",
                "lastname"=>"Simpson",
                "sex"=>"female",
                "date_of_birth"=>"1981-05-09",
                'father'=>FamilyMember::getSeedID('homer'),
                'mother'=>FamilyMember::getSeedID('marge')
            ],
            'maggie'=>[
                'firstname'=>"Maggie",
                "lastname"=>"Simpson",
                "sex"=>"female",
                'father'=>FamilyMember::getSeedID('homer'),
                'mother'=>FamilyMember::getSeedID('marge')
            ]
        ]);
        
    }
    
    protected function seedClips()
    {
        Clip::seed([
            'bartsfirststeps'=>[
                'name'=>"Bart's first steps",
                'original_name'=>"Bart's first steps",
                'sort_name'=>"BARTSFIRSTSTEPS",
                'relation'=>Clip::getSeedID('bart'),
                'type'=>'private'
            ],
            [
                'name'=>"Lisa's first steps",
                'original_name'=>"Lisa's first steps",
                'sort_name'=>"LISASFIRSTSTEPS",
                'relation'=>Clip::getSeedID('lisa'),
                'type'=>'private'
            ],
        ]);
    }
    
    protected function seedPersonsRelations()
    {
        PersonsRelation::seed([
            [
                'person1'=>FamilyMember::getSeedID('homer'),
                'person2'=>FamilyMember::getSeedID('marge'),
                'relation'=>'marriage'
            ]
        ]);
    }
    
    protected function seedAnniversaries()
    {
        Anniversary::seed([
            ['name'=>"Homer's birthday", 'first'=>'1956-05-12', 'type'=>'birthday', 'persons'=>[Anniversary::getSeedID('homer')]],
            ['name'=>"Bart's birthday", 'first'=>'1980-02-03', 'type'=>'birthday', 'persons'=>[Anniversary::getSeedID('bart')]],
            ['name'=>"Lisa's birthday", 'first'=>'1981-05-09', 'type'=>'birthday', 'persons'=>[Anniversary::getSeedID('lisa')]],
        ]);
    }
    
    protected function seedEvents()
    {
        Event::seed([
            [
                'who'=>Event::getSeedID('homer'),
                'when'=>'2023-09-13 11:39:00',
                'what'=>Event::getSeedID('watch'),
                'to_whom'=>Event::getSeedID('fightclub')
            ],
        ]);
    }
    
    protected function seedNetworks()
    {
        Network::seed([
            'homenet'=>[
                'name'=>'home',
                'prefix'=>'192.168',
                'description'=>'The home network'
            ]
        ]);
        Network::seed([
            'dmz'=>[
                'name'=>'dmz',
                'prefix'=>'192.168.1',
                'description'=>'The demilitarized zone',
                'part_of'=>Network::getSeedID('homenet')
            ],
            'int'=>[
                'name'=>'int',
                'prefix'=>'192.168.2',
                'description'=>'The internal network',
                'part_of'=>Network::getSeedID('homenet')
            ],
        ]);
    }
    
    protected function seedManufacturers()
    {
        Manufacturer::seed([
            'sorny'=>['name'=>'Sorny','product_groups'=>[Manufacturer::getSeedID('electronics')]],
            'mapple'=>['name'=>'Mapple','product_groups'=>[Manufacturer::getSeedID('electronics')]],
        ]);
    }
    
    protected function seedShops()
    {
        Shop::seed([
            'quick'=>['name'=>'Quick-E-Mart', 'kind'=>'local'],
            'amazon'=>['name'=>'Amazon','kind'=>'online'],
        ]);
    }
    
    public function seedDatabase()
    {
        
        // Seed non dependent tables
        $this->seedProductGroups();
        $this->seedLanguages();
        $this->seedNetworks();
        $this->seedEventTypes();
        $this->seedGenres();
        $this->seedStaffJobs();
        $this->seedMusicalArtists();
        
        $this->seedFamilyMembers();
        $this->seedPersons();
        $this->seedFriends();
        $this->seedStaff();
        
        // Seed locations
        $this->seedCountries();
        $this->seedCities();
        $this->postSeedCountries();
        $this->seedStreets();
        $this->seedAddresses();
        $this->seedFloors();
        $this->seedRooms();
        $this->seedPseudoLocations();
        
        $this->seedTVSeries();
        $this->seedMovies();
        $this->seedMovieSeries();
        $this->seedEpisodes();
        $this->seedClips();
        
        $this->seedPersonsRelations();
        $this->seedAnniversaries();
        
        $this->seedManufacturers();
        $this->seedShops();
        
        $this->seedEvents();
        
        $this->seedTags();
        $this->seedAttributes();
        $this->seedFilters();
        
    }
    
}
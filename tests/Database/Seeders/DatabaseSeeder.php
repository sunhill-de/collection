<?php
namespace Sunhill\Collection\Tests\Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(ObjectsTableSeeder::class);
        $this->call(StringObjectAssignsTableSeeder::class);
        $this->call(ObjectObjectAssignsTableSeeder::class);
        
        $this->call(PersonsTableSeeder::class);
        $this->call(FriendsTableSeeder::class);
        $this->call(FamilyMembersTableSeeder::class);

        $this->call(LocationsTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        
    }
}

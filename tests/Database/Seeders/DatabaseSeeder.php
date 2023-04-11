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
        $this->call(StreetsTableSeeder::class);
        $this->call(AddressesTableSeeder::class);
        
        $this->call(AnniversariesTableSeeder::class);
        $this->call(DatesTableSeeder::class);
        $this->call(CelebrationsTableSeeder::class);
        $this->call(AnniversaryCelebrationsTableSeeder::class);

        $this->call(NetworksTableSeeder::class);
        $this->call(ServersTableSeeder::class);
        $this->call(ComputersTableSeeder::class);
        $this->call(NetworkDevicesTableSeeder::class);
        $this->call(ElectronicDevicesTableSeeder::class);
        $this->call(PropertiesTableSeeder::class);
        
        $this->call(OrganisationsTableSeeder::class);
        $this->call(ShopsTableSeeder::class);
        
        $this->call(MusicalArtistsTableSeeder::class);
    }
}

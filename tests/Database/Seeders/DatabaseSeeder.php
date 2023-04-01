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
        
        $this->call(PersonsTableSeeder::class);
    }
}

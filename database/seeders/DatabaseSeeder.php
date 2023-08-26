<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Country;
use App\Models\Product;
use App\Models\Continent;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $continents = [
            ['id' => 1, 'name' => 'Europe'],
            ['id' => 2, 'name' => 'Asia'],
            ['id' => 3, 'name' => 'Africa'],
            ['id' => 4, 'name' => 'North America'],
            ['id' => 5, 'name' => 'South America'],
            ['id' => 6, 'name' => 'Antartida'],
            ['id' => 7, 'name' => 'Oceania'],
        ];

        foreach($continents as $continent) {
            Continent::factory()->create($continent)
                ->each(function ($c) {
                $c->countries()->saveMany(Country::factory(5)->make());
            });
        }    
    
        Product::factory(20)->create();
    
    }
}

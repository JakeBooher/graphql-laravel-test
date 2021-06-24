<?php

namespace Database\Seeders;

use App\Models\Example;
use App\Models\ExampleRelation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Example::factory()->count(10)
            ->has(ExampleRelation::factory()->count(5), 'exampleRelations')
            ->create();
    }
}

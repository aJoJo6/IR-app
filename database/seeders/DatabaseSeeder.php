<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// app seeder
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RevolutionSeeder::class, // seed revolutions
            EvaluationSeeder::class,
        ]);
    }
}
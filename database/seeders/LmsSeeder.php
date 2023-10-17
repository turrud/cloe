<?php

namespace Database\Seeders;

use App\Models\Lms;
use Illuminate\Database\Seeder;

class LmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lms::factory()
            ->count(5)
            ->create();
    }
}

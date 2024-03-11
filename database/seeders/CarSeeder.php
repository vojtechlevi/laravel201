<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Cars;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class CarSeeder extends Seeder
{
    public function run(): void
    {
        Cars::factory(6)->create();
    }
}

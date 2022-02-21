<?php

namespace Database\Seeders;

use App\Models\Donos;
use Illuminate\Database\Seeder;

class DonosTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Donos::factory(100)->create();
    }
}

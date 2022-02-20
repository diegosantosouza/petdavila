<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TutorTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Tutor::class, 20)->create();
    }
}

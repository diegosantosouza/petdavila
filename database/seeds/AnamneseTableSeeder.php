<?php

use Illuminate\Database\Seeder;

class AnamneseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Anamnese::class, 200)->create();
    }
}

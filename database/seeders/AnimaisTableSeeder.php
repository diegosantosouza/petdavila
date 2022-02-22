<?php

namespace Database\Seeders;

use App\Models\Animais;
use Illuminate\Database\Seeder;

class AnimaisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Animais::factory(300)->create();
    }
}

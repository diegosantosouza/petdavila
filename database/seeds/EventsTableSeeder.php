<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('events')->insert([
            [
                'title'=>'Vacina',
                'start'=>'2020-08-05 06:30:00',
                'end'=>'2020-08-05 07:45:00',
                'color'=>'#32a86d',
                'description'=>'Vacina Malu',
            ],
            [
                'title'=>'Consulta',
                'start'=>'2020-08-06 10:30:00',
                'end'=>'2020-08-06 12:45:00',
                'color'=>'#a85032',
                'description'=>'Consulta Malu',
            ],
        ]);
    }
}

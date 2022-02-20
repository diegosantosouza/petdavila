<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('categorias')->insert([
            [
                'categoria'=>'avulso'
            ],
            [
                'categoria'=>'mensal'
            ],
            [
                'categoria'=>'triagem'
            ],
        ]);
    }
}

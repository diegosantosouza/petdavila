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
                'categoria'=>'avulso',
                'created_at'=>now()
            ],
            [
                'categoria'=>'mensal',
                'created_at'=>now()
            ],
            [
                'categoria'=>'triagem',
                'created_at'=>now()
            ],
        ]);
    }
}

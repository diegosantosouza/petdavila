<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceiroDonosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financeiro_donos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donos_id')->references('id')->on('donos')->onDelete('cascade');
            $table->string('operador')->nullable();
            $table->decimal('valor', 10, 2);
            $table->string('servico');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financeiro_donos');
    }
}

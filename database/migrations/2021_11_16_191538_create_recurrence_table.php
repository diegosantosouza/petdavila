<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecurrenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recurrence', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tutor_id')->references('id')->on('donos');
            $table->foreignId('service_id')->references('id')->on('service');
            $table->dateTime('start');
            $table->dateTime('end')->nullable();
            $table->string('status', 20);
            $table->string('method', 20);
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
        Schema::dropIfExists('recurrence');
    }
}

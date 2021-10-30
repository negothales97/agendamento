<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variables', function (Blueprint $table) {
            $table->id();
            $table->integer('mins_available_after_closing');
            $table->integer('tolerance_mins');
            $table->integer('percentage');
            $table->integer('chargeback_1');
            $table->integer('chargeback_2');
            $table->integer('chargeback_3');
            $table->integer('chargeback_4');

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
        Schema::dropIfExists('variables');
    }
}

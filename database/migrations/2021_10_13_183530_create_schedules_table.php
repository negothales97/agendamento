<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('init_hour');
            $table->string('final_hour');
            $table->string('transaction_status')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('agoraio_token')->nullable();
            $table->string('agoraio_channel')->nullable();
            $table->integer('status')->default(0);
            $table->integer('price');

            $table->foreignId('specialist_id');
            $table->foreignId('customer_id')
                ->nullable();
            $table->foreignId('place_id')
                ->nullable()
                ->onDelete('cascade');
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
        Schema::dropIfExists('schedules');
    }
}

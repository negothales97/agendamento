<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id');
            $table->string('transaction_status');
            $table->string('type');
            $table->string('description');
            $table->integer('value');
            $table->integer('value_avivare')->default(0);
            $table->integer('value_specialist')->default(0);
            $table->foreignId('customer_id')->nullable();
            $table->foreignId('specialist_id')->nullable();
            $table->foreignId('schedule_id')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}

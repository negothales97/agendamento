<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->text('abstract');
            $table->string('picture');
            $table->string('bank_code');
            $table->string('agencia');
            $table->string('agencia_dv')->nullable();
            $table->string('conta');
            $table->string('conta_dv');
            $table->string('document_number');
            $table->string('recipient_id');
            $table->string('bank_account_id');
            $table->integer('use_online')->default(1);
            $table->unsignedBigInteger('specialty_id');
            $table->unsignedBigInteger('specialty_category_id');
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
        Schema::dropIfExists('specialists');
    }
}

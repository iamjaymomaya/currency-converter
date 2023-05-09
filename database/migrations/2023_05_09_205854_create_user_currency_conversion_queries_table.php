<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_currency_conversion_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('from');
            $table->string('to');
            $table->decimal('amount', 12, 6);
            $table->decimal('value', 12, 6)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_currency_conversion_logs');
    }
};

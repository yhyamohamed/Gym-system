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
        Schema::create('training_package_user', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('training_package_id');
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('training_package_id')->references('id')->on('training_packages');
            // $table->foreign('user_id')->references('id')->on('users');
            $table->foreignId('training_package_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->unsignedBigInteger('amount_paid');
            $table->integer('remaining_sessions');
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
        Schema::dropIfExists('training_package_user');
    }
};

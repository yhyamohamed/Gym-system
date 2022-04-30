<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainningSessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->time('start_at');
            $table->time('finish_at');
            $table->unsignedBigInteger('gym_id');
            $table->unsignedBigInteger('training_package_id');
            $table->foreign('gym_id')->references('id')->on('gym');
            $table->foreign('training_package_id')->references('id')->on('training_packages');
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
        Schema::dropIfExists('trainning_session');
    }
}

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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->enum('gender',['male','female']);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->date('date_of_birth')->nullable();
            $table->string('profile_image')->nullable();
            $table->foreignId('possession_id')->nullable()->constrained()->nullOnDelete()->onUpdate('cascade');
            $table->rememberToken();
            $table->timestamp('banned_at')->nullable();
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
        Schema::dropIfExists('users');
    }
};

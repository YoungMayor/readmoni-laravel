<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('user_key', 8)->unique();
            $table->string('email')->unique();

            $table->string('full_name');
            $table->string('chat_name')->unique();
            $table->string('telephone');
            $table->string('address', 240)->default('Nigeria');
            $table->date('dob');
            $table->enum('sex', ['m', 'f', 'u'])->default('u');
            $table->enum('account_activated', ['n', 'y'])->default('n');
            $table->string('referer', 8)->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
}

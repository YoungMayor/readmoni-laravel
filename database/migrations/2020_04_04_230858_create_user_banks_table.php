<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_banks', function (Blueprint $table) {
            $table->id();

            $table->string('user_key', 8);
            $table->text('bank_name')->nullable();
            $table->text('account_name')->nullable();
            $table->text('account_number')->nullable();

            $table->timestamps();
            
            $table->foreign('user_key')->references('user_key')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_banks', function (Blueprint $table) {
            $table->dropForeign('user_banks_user_key_foreign');
        });

        Schema::dropIfExists('user_banks');
    }
}

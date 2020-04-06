<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_payments', function (Blueprint $table) {
            $table->id(); 

            $table->string('user_key', 8);
            $table->text('transaction_reference');
            $table->string('amount', 13)->default(env('REGISTRATION_FEE', '2600'));

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
        Schema::table('registration_payments', function (Blueprint $table) {
            $table->dropForeign('registration_payments_user_key_foreign');
        });

        Schema::dropIfExists('registration_payments');
    }
}

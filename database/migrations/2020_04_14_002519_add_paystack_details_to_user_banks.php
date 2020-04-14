<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaystackDetailsToUserBanks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_banks', function (Blueprint $table) {
            $table->string('bank_code', 8)->nullable()->after('account_number');
            $table->string('recipient_code', 24)->nullable()->after('bank_code')->unique();
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
            $table->dropColumn('bank_code');
            $table->dropColumn('recipient_code');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Update invoices table
        Schema::table('invoices', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
            $table->string('guest_name')->nullable()->after('user_id');
        });

        // Update payments table
        Schema::table('payments', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
            $table->string('guest_name')->nullable()->after('user_id');
        });
    }

    public function down()
    {
        // Reverse the changes
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('guest_name');
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('guest_name');
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
        });
    }
};

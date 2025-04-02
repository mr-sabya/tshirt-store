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
        Schema::table('orders', function (Blueprint $table) {
            // Make user_id nullable for guest checkout
            $table->unsignedBigInteger('user_id')->nullable()->change();

            // Add guest checkout fields
            $table->string('guest_name')->nullable()->after('user_id');
            $table->string('guest_phone')->nullable()->after('guest_name');
            $table->text('guest_address')->nullable()->after('guest_phone');
            $table->foreignId('division_id')->nullable()->constrained()->nullOnDelete()->after('guest_address');
            $table->foreignId('city_id')->nullable()->constrained()->nullOnDelete()->after('division_id');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Remove guest checkout fields
            $table->dropColumn(['guest_name', 'guest_phone', 'guest_address', 'division_id', 'city_id']);

            // Make user_id required again (if needed, adjust accordingly)
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
        });
    }
};

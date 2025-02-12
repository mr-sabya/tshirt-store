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
        Schema::table('leads', function (Blueprint $table) {
            $table->string('name')->nullable();               // Lead's name/contact person
            $table->string('email')->nullable();              // Lead's email address
            $table->string('phone')->nullable();              // Lead's phone number
            $table->string('address')->nullable();            // Lead's address
            $table->string('company_name')->nullable();       // Lead's company name (optional)
            $table->string('lead_source')->nullable();        // Source of the lead (e.g., website, ad)
            $table->integer('lead_score')->nullable();        // Lead scoring (optional)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn(['name', 'email', 'phone', 'address', 'company_name', 'lead_source', 'lead_score']);
        });
    }
};

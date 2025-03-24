<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hot_offers', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Title of the hot offer
            $table->text('text'); // Description of the offer
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Foreign key for the product
            $table->string('image')->nullable(); // Image associated with the offer
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hot_offers');
    }
};

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
        Schema::create('customization_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customization_category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->decimal('price', 8, 2)->nullable();
            $table->string('image')->nullable(); // mockup image
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customization_options');
    }
};

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
        Schema::create('product_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customization_category_id')    // Foreign key referencing customization_categories table
                ->constrained()                            // This automatically references the 'id' column of the customization_categories table
                ->onDelete('cascade');                     // Cascade delete if customization category is deleted
            $table->string('material');                        // E.g., Cotton, Jersey, China Rim Mug
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_options');
    }
};

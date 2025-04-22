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
        Schema::create('order_customizations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('customization_category_id')->constrained()->onDelete('cascade');
            $table->foreignId('customization_option_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_option_id')->constrained()->onDelete('cascade');
            
            $table->foreignId('design_id')->nullable()->constrained()->onDelete('cascade');
            
            $table->string('image')->nullable(); // or any file/url/text related to design
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_customizations');
    }
};

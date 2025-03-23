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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // References the users table
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // References the products table
            $table->foreignId('product_variation_id')->nullable()->constrained()->onDelete('cascade'); // References the variations table
            $table->foreignId('size_id')->nullable()->constrained()->onDelete('cascade'); // References the sizes table
            $table->integer('quantity')->default(1); // Quantity of the item in the cart
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};

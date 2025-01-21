<?php

use App\Models\Category;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique();

            $table->decimal('price', 10, 2);
            $table->decimal('regular_price', 10, 2)->nullable();
            $table->decimal('buy_price', 10, 2)->nullable();
            $table->decimal('cost_price', 10, 2)->nullable();

            $table->boolean('is_stock')->default(true);
            $table->integer('stock')->default(0);

            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete();
            $table->string('image')->nullable();
            $table->longText('details')->nullable();
            $table->string('short_desc')->nullable();

            $table->boolean('status')->default(true); // Active or inactive product
            $table->boolean('featured')->default(false); // Mark product as featured
            $table->decimal('discount', 10, 2)->default(0); // Optional discount

            $table->timestamps();
            $table->softDeletes(); // Enables soft deleting
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

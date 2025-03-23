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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Payment method name (e.g., "Cash on Delivery", "Bkash")
            $table->text('description')->nullable(); // Description of the payment method
            $table->boolean('is_active')->default(true); // Whether the payment method is active
            $table->string('bkash_number')->nullable(); // For Bkash payment
            $table->string('bank_account_number')->nullable(); // For bank transfer payment
            $table->string('third_party_gateway_details')->nullable(); // For third-party payment gateways like Stripe, PayPal, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};

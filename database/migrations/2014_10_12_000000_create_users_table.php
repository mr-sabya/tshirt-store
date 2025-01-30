<?php

use App\Models\City;
use App\Models\Division;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->unique();
            $table->boolean('is_verified')->default(0);
            $table->string('password');
            $table->foreignIdFor(Division::class)->constrained()->cascadeOnDelete()->nullable();
            $table->foreignIdFor(City::class)->constrained()->cascadeOnDelete()->nullable();
            $table->string('postcode')->nullable();
            $table->string('address')->nullable();
            $table->string('image')->nullable();

            $table->boolean('is_admin')->default(0);
            $table->boolean('is_designer')->default(0);
            $table->boolean('is_approved')->default(1);

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

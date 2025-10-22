<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('company_name');
            $table->string('business_type')->nullable();
            $table->text('product_catalog')->nullable();
            $table->string('delivery_options')->nullable();
            $table->string('payment_terms')->nullable();
            $table->decimal('rating', 3, 2)->nullable();
            $table->timestamps();

            // Ensure one supplier per user
            $table->unique('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};

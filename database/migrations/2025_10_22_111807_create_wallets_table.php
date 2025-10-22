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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // nom du wallet
            $table->integer('donation_count')->default(0); // nombre de donations
            $table->decimal('total_amount', 15, 2)->default(0); // montant total collecté
            $table->decimal('target_amount', 15, 2); // montant cible
            $table->foreignId('event_id')->constrained()->onDelete('cascade'); // relation avec l'événement
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};

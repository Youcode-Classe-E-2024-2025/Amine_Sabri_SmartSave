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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained()->onDelete('cascade'); // Profil lié
            $table->enum('type', ['Revenu', 'Dépense']); // Revenu ou Dépense
            $table->decimal('amount', 10, 2); // Montant
            $table->string('category'); 
            $table->string('description')->nullable(); // Détails
            $table->date('date'); // Date de transaction
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

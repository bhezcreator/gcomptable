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
        Schema::create('financial_statements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fiscal_period_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->enum('type', [
                'balance_generale',
                'grand_livre',
                'journal',
                'bilan',
                'compte_de_resultat',
                'situation_de_tresorerie',
            ]);
            $table->enum('status', [
                'brouillon',
                'genere',
                'valide',
                'publie',
                'archive',
            ])->default('brouillon');
            $table->timestamps();
            $table->softDeletes();

            // Un même type d'état ne peut exister qu'une fois par période
            $table->unique(['fiscal_period_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_statements');
    }
};

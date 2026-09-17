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
        Schema::create('bank_reconciliations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bank_account_id')->constrained()->cascadeOnDelete();
            $table->foreignId('period_id')->constrained('fiscal_periods')->restrictOnDelete();
            $table->decimal('statement_balance', 18, 2)->default(0);
            $table->decimal('book_balance', 18, 2)->default(0);
            $table->decimal('difference', 18, 2)->default(0);
            $table->enum('status', [
                'brouillon',
                'en_cours',
                'rapproche',
                'ecart',
                'valide',
            ])->default('brouillon');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['bank_account_id', 'period_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_reconciliations');
    }
};

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
        Schema::create('mission_settlements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mission_id')->constrained()->cascadeOnDelete();
            $table->decimal('advance_amount', 18, 2)->default(0);
            $table->decimal('total_expenses', 18, 2)->default(0);
            $table->decimal('amount_to_return', 18, 2)->default(0);
            $table->decimal('additional_amount', 18, 2)->default(0);
            $table->date('settlement_date');
            $table->enum('status', [
                'brouillon',
                'soumis',
                'valide',
                'rejete',
                'cloture',
            ])->default('brouillon');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mission_settlements');
    }
};

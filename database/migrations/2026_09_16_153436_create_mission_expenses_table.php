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
        Schema::create('mission_expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mission_id')->constrained()->cascadeOnDelete();
            $table->date('expense_date');
            $table->enum('expense_type', [
                'transport',
                'hebergement',
                'restauration',
                'carburant',
                'communication',
                'frais_divers',
                'autre',
            ])->default('autre');
            $table->text('description')->nullable();
            $table->decimal('amount', 18, 2)->default(0);
            $table->foreignId('currency_id')->constrained()->restrictOnDelete();
            $table->string('receipt_reference')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mission_expenses');
    }
};

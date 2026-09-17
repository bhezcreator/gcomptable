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
        Schema::create('funding_conventions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('funder_id')->constrained()->restrictOnDelete();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->string('reference')->unique();
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('initial_amount', 18, 2)->default(0);
            $table->foreignId('currency_id')->constrained()->restrictOnDelete();
            $table->enum('status', [
                'brouillon',
                'active',
                'suspendue',
                'cloturee',
                'annulee',
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
        Schema::dropIfExists('funding_conventions');
    }
};

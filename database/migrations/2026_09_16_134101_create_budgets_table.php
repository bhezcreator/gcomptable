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
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('fiscal_year_id')->constrained()->restrictOnDelete();
            $table->string('name');
            $table->unsignedInteger('version')->default(1);
            $table->enum('status', [
                'brouillon',
                'soumis',
                'approuve',
                'rejete',
                'cloture',
            ])->default('brouillon');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['project_id', 'fiscal_year_id', 'version']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};

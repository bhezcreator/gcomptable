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
        Schema::create('contracts', function (Blueprint $table) {
 $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('funder_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('supplier_id')->nullable()->constrained('third_parties')->nullOnDelete();
            $table->string('contract_number')->unique();
            $table->string('title');
            $table->enum('contract_type', [
                'prestation_services',
                'fourniture_bien',
                'travaux',
                'consultance',
                'subvention',
                'bail',
                'autre',
            ])->default('autre');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->decimal('initial_amount', 18, 2)->default(0);
            $table->decimal('revised_amount', 18, 2)->default(0);
            $table->foreignId('currency_id')->constrained()->restrictOnDelete();
            $table->enum('status', [
                'brouillon',
                'actif',
                'suspendu',
                'termine',
                'resilie',
                'annule',
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
        Schema::dropIfExists('contracts');
    }
};

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
        Schema::create('funding_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('funding_convention_id')->constrained()->cascadeOnDelete();
            $table->string('code');
            $table->string('name');
            $table->decimal('budget_amount', 18, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['funding_convention_id', 'code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funding_categories');
    }
};

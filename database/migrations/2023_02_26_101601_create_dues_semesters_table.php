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
        Schema::create('dues_semesters', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->foreignId('semester_id')->constrained()->onDelete('cascade');
            $table->integer('level');
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['level', 'semester_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dues_semesters');
    }
};

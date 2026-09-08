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
        Schema::create('difficulty_bandit_interactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('skill_id')->constrained('skills')->onDelete('cascade');
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade');

            $table->string('arm');
            $table->string('selection_source');
            $table->json('context');
            $table->decimal('previous_mastery', 6, 5);
            $table->boolean('is_correct');
            $table->decimal('new_mastery', 6, 5);
            $table->decimal('reward', 8, 5);

            $table->timestamps();

            $table->index(['skill_id', 'arm']);
            $table->index(['student_id', 'skill_id']);
            $table->index('selection_source');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('difficulty_bandit_interactions');
    }
};

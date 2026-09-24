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
        Schema::create('difficulty_bandit_refit_logs', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('running'); // pending|running|success|failed
            $table->text('error')->nullable();
            $table->integer('interaction_count')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('difficulty_bandit_refit_logs');
    }
};

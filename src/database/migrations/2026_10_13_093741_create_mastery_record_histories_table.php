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
        Schema::create('mastery_record_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mastery_record_id')->constrained('mastery_records')->onDelete('cascade');
            $table->float('previous_mastery')->default(0);
            $table->float('new_mastery');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mastery_record_histories');
    }
};

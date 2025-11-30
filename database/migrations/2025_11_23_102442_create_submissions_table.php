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
    Schema::create('submissions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('challenge_id')->constrained()->onDelete('cascade');
        $table->foreignId('artwork_id')->constrained()->onDelete('cascade');
        $table->boolean('is_winner')->default(false); // untuk menandai pemenang
        $table->string('winner_position')->nullable(); // e.g., "1st", "2nd", dll
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};

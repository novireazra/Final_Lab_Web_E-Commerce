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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('id_review');
            $table->foreignId('id_buyer')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_restaurant')->constrained('restaurants')->onDelete('cascade');
            $table->integer('rating');
            $table->text('komentar');
            $table->timestamp('tanggal_review')->useCurrent();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};

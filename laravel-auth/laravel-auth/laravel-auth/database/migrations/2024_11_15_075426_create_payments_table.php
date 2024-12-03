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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_order')->constrained('orders')->onDelete('cascade');
            $table->enum('metode_pembayaran', ['Cash', 'E-Wallet', 'Bank Transfer']);
            $table->enum('status_pembayaran', ['Pending', 'Completed', 'Failed']);
            $table->timestamp('tanggal_pembayaran')->useCurrent();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

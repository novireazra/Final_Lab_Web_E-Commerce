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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_buyer')->constrained('users')->onDelete('cascade'); // Menghubungkan ke tabel users
            $table->timestamp('tanggal_pesanan')->useCurrent();
            $table->decimal('total_harga', 10, 2);
            $table->enum('status_order', ['Pending', 'Confirmed', 'Delivered', 'Canceled']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id('id_order_detail'); // Primary key
            $table->foreignId('id_order')->constrained('orders')->onDelete('cascade'); // Relasi ke tabel orders
            $table->foreignId('id_menu')->constrained('menus')->onDelete('cascade'); // Relasi ke tabel menus
            $table->integer('quantity')->unsigned(); // Jumlah item
            $table->decimal('price', 10, 2); // Harga per item
            $table->decimal('subtotal', 10, 2); // Harga total (quantity * price)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};

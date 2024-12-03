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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_restaurant')->constrained('restaurants')->onDelete('cascade');
            $table->string('nama_menu');
            $table->text('deskripsi_menu');
            $table->decimal('harga', 10, 2);
            $table->enum('status', ['Available', 'Unavailable']);
            $table->string('kategori');
            $table->string('image')->nullable();
            $table->integer('stock')->default(0); // Menambahkan kolom stock
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};

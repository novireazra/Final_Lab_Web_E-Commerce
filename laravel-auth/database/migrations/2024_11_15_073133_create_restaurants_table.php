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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_seller')->constrained('users')->onDelete('cascade');
            $table->string('nama_restaurant');
            $table->text('deskripsi');
            $table->text('alamat');
            $table->string('image')->nullable(); // Menambahkan kolom image
            $table->enum('status_buka', ['Open', 'Close']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }


};

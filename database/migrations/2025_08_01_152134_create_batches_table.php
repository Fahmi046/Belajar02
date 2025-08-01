<?php
// database/migrations/YYYY_MM_DD_HHMMSS_create_batches_table.php

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
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->string('batch_number');
            $table->date('expiry_date');
            $table->integer('current_stock'); // Stok yang tersedia untuk batch ini
            $table->string('location')->nullable(); // Misal: Gudang A, Rak 1
            $table->timestamps();

            // Kombinasi product_id dan batch_number harus unik
            $table->unique(['product_id', 'batch_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
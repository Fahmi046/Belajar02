<?php

// database/migrations/YYYY_MM_DD_HHMMSS_create_products_table.php

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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku')->unique()->nullable(); // Stock Keeping Unit
            $table->string('brand')->nullable();
            $table->string('formulation')->nullable(); // Bentuk sediaan: Tablet, Sirup, Injeksi
            $table->string('strength')->nullable(); // Kekuatan: 500mg, 100ml
            $table->decimal('hna', 10, 2)->default(0); // Harga Netto Apotek
            $table->decimal('sell_price', 10, 2)->default(0); // Harga Jual PBF
            $table->string('unit')->nullable(); // Satuan: Box, Strip, Botol, Pcs
            $table->integer('min_stock_level')->default(0); // Batas stok minimum
            $table->boolean('is_active')->default(true); // Status produk aktif/tidak
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
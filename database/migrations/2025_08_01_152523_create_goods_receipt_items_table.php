<?php
// database/migrations/YYYY_MM_DD_HHMMSS_create_goods_receipt_items_table.php

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
        Schema::create('goods_receipt_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('goods_receipt_id')->constrained('goods_receipts')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('batch_id')->nullable()->constrained('batches')->onDelete('set null'); // Akan diisi saat menyimpan
            $table->string('batch_number_received'); // Nomor batch yang benar-benar diterima (bisa baru)
            $table->date('expiry_date_received'); // Tanggal kadaluarsa yang benar-benar diterima
            $table->integer('quantity_received');
            $table->decimal('unit_price_at_receipt', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods_receipt_items');
    }
};
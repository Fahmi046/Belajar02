<?php
// database/migrations/YYYY_MM_DD_HHMMSS_create_goods_issue_items_table.php

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
        Schema::create('goods_issue_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('goods_issue_id')->constrained('goods_issues')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('batch_id')->constrained('batches'); // Merujuk batch yang dikeluarkan
            $table->integer('quantity_issued');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods_issue_items');
    }
};
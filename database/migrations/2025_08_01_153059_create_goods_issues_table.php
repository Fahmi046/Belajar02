<?php
// database/migrations/YYYY_MM_DD_HHMMSS_create_goods_issues_table.php

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
        Schema::create('goods_issues', function (Blueprint $table) {
            $table->id();
            $table->string('issue_number')->unique();
            $table->foreignId('sales_order_id')->constrained('sales_orders')->onDelete('cascade');
            $table->date('issue_date');
            $table->text('notes')->nullable();
            $table->foreignId('issued_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods_issues');
    }
};
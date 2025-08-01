<?php

// database/migrations/YYYY_MM_DD_HHMMSS_create_invoices_table.php

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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->foreignId('sales_order_id')->constrained('sales_orders')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('customers');
            $table->date('invoice_date');
            $table->date('due_date');
            $table->decimal('total_amount', 12, 2);
            $table->enum('status', ['unpaid', 'paid', 'partially_paid', 'canceled'])->default('unpaid');
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
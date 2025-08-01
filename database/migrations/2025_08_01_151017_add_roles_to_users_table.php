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
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom 'role' untuk hak akses (misal: admin, gudang, sales)
            $table->string('role')->default('sales')->after('email');
            // Tambahkan kolom lain jika diperlukan, misal 'phone_number', 'address'
            $table->string('phone_number')->nullable()->after('role');
            $table->text('address')->nullable()->after('phone_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'phone_number', 'address']);
        });
    }
};

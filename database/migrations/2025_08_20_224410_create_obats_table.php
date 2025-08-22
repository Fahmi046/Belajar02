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
        Schema::create('obats', function (Blueprint $table) {
            $table->id();
            $table->string('kode_obat')->unique();
            $table->string('nama_obat');
            $table->string('pabrik')->nullable();
            $table->string('golongan')->nullable();
            $table->string('komposisi')->nullable();
            $table->boolean('generik')->default(false);
            $table->string('kemasan')->nullable();
            $table->string('satuan')->nullable();
            $table->integer('isi_obat')->nullable();
            $table->string('dosis')->nullable();
            $table->string('sediaan')->nullable();
            $table->string('barcode')->nullable();
            $table->decimal('harga_hna', 12, 2)->nullable();
            $table->decimal('harga_ppn', 12, 2)->nullable();
            $table->decimal('hja', 12, 2)->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obats');
    }
};

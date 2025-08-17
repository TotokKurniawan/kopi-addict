<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('meja_id')->nullable()->constrained('mejas')->onDelete('set null');
            $table->enum('status', ['lunas', 'belum lunas'])->default('belum lunas');
            $table->enum('pembayaran', ['cash', 'qris'])->nullable();
            $table->integer('bayar')->nullable();
            $table->integer('kembalian')->nullable();
            $table->integer('total')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};

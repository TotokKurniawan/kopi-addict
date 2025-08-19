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
        Schema::create('cart_mejas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meja_id')->constrained('mejas')->onDelete('cascade');
            $table->foreignId('menu_id')->constrained('menus')->onDelete('cascade');
            $table->integer('qty')->default(1);
            $table->integer('harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_mejas');
    }
};

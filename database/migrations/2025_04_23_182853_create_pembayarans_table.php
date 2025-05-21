<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kontrak_id')->constrained('kontraks');
            $table->foreignId('user_id')->constrained('users');
            $table->decimal('harga', 10, 2);
            $table->enum('metode_pembayaran', ['cash', 'transfer']);
            $table->string('bukti_transfer')->nullable();
            $table->enum('status', ['lunas', 'belum-lunas']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
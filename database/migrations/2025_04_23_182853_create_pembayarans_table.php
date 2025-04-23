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
            $table->foreignId('kontrak_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->decimal('harga');
            $table->enum('metode_pembayaran', ['e_money', 'bank']);
            $table->enum('status', ['gagal', 'pending', 'sukses']);
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

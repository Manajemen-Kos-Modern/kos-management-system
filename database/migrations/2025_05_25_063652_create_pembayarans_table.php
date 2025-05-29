<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kontrak_id')->constrained('kontraks')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('harga', 10, 2);
            $table->enum('metode_pembayaran', ['cash', 'transfer', 'qris']);
            $table->enum('status', ['menunggu', 'dibayar', 'gagal']);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('pembayarans');
    }
};

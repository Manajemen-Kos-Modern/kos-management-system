<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('kontraks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('kamar_id')->constrained('kamars')->onDelete('cascade');
            $table->date('tanggal_mulai');
            $table->integer('durasi_sewa');
            $table->enum('status', ['aktif', 'selesai', 'dibatalkan']);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('kontraks');
    }
};
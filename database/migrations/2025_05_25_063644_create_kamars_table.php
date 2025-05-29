<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_kamar');
            $table->string('tipe_kamar');
            $table->decimal('harga', 10, 2);
            $table->enum('status', ['kosong', 'terisi', 'perawatan']);
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('kamars');
    }
};

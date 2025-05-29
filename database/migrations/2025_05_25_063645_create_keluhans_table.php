<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('keluhans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('kamar_id')->constrained('kamars')->onDelete('cascade');
            $table->text('keterangan');
            $table->enum('status', ['pending', 'diproses', 'selesai']);
            $table->string('jenis_keluhan');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('keluhans');
    }
};

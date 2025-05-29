<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('pemeliharaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kamar_id')->constrained('kamars')->onDelete('cascade');
            $table->enum('status', ['dijadwalkan', 'sedang_berlangsung', 'selesai']);
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('pemeliharaans');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->enum('tipe', ['izin', 'sakit', 'cuti']);
            $table->text('alasan')->nullable();

            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();

            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};

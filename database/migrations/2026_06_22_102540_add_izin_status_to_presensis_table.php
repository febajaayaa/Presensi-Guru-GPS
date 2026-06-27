<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('presensis', function (Blueprint $table) {
            $table->string('izin_status')->nullable()->after('status');
            // Tambahkan kolom lain jika perlu, misal tanggal_mulai:
            // $table->date('tanggal_mulai')->nullable()->after('tanggal');
        });
    }

    public function down(): void
    {
        Schema::table('presensis', function (Blueprint $table) {
            $table->dropColumn('izin_status');
        });
    }
};
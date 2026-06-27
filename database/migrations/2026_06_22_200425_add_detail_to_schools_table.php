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
    Schema::table('schools', function (Blueprint $table) {
        $table->string('npsn')->nullable()->after('nama_sekolah');
        $table->string('akreditasi')->nullable()->after('npsn');
        $table->string('kota')->nullable()->after('akreditasi');
        $table->string('logo')->nullable()->after('kota');
        $table->text('deskripsi')->nullable()->after('logo');
    });
}

public function down(): void
{
    Schema::table('schools', function (Blueprint $table) {
        $table->dropColumn(['npsn', 'akreditasi', 'kota', 'logo', 'deskripsi']);
    });
}
};

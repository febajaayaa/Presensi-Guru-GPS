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
    Schema::table('users', function (Blueprint $table) {
        // Cek dulu sebelum tambah
        if (!Schema::hasColumn('users', 'school_id')) {
            $table->unsignedBigInteger('school_id')->nullable()->after('role');
        }
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropForeignIdFor(\App\Models\School::class);
        $table->dropColumn('school_id');
    });
}
};

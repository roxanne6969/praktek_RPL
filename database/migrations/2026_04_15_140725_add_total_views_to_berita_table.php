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
    Schema::table('berita', function (Blueprint $table) {
        // Menambahkan kolom total_views dengan nilai default 0
        $table->integer('total_views')->default(0);
    });
}

public function down(): void
{
    Schema::table('berita', function (Blueprint $table) {
        // Menghapus kolom jika migration di-rollback
        $table->dropColumn('total_views');
    });
}
};

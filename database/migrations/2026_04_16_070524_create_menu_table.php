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
        Schema::create('menu', function (Blueprint $table) {
        $table->increments('id_menu');
        $table->string('nama_menu');
        $table->enum('jenis_menu', ['url', 'page']); // Pilihan tipe menu
        $table->string('url_menu');
        $table->string('target_menu')->default('_self'); // Buka di tab yang sama atau baru
        $table->integer('urutan_menu');
        $table->integer('parent_menu')->nullable(); // Untuk submenu
        $table->boolean('status_menu')->default(1);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};

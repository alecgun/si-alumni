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
        Schema::create('ticket', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('judul');
            $table->string('status_ticket')->default('Open'); // open, closed
            $table->enum('kategori', ['Pengumuman', 'Tambah Data User/Alumni', 'Lain-lain']);
            $table->longText('deskripsi');
            $table->string('email');
            $table->foreignUuid('id_user')->constrained('users')->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket');
    }
};

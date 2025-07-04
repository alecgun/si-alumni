<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kerja', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('alumni_id')->constrained('alumni')->restrictOnDelete();
            $table->string('posisi_kerja');
            $table->string('tempat_kerja');
            $table->string('alamat_kerja');
            $table->year('tahun_masuk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kerja');
    }
};

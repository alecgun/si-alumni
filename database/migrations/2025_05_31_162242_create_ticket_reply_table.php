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
        Schema::create('ticket_reply', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->longText('reply_text');
            $table->foreignUuid('id_ticket')->constrained('ticket')->restrictOnDelete();
            $table->foreignUuid('id_user')->constrained('users')->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_reply');
    }
};

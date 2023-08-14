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
        Schema::create('bursas', function (Blueprint $table) {
            $table->id();
            $table->string("status");
            $table->text("alamat_lengkap");
            $table->text("deskripsi");
            $table->foreignId('user_id')->constrained(
                table: 'users',
                column: 'id',
                indexName: 'bursas_user_id',
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bursas');
    }
};

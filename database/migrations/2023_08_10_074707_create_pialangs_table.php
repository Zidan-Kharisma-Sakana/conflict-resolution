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
        Schema::create('pialangs', function (Blueprint $table) {
            $table->id();
            $table->string("nama_pialang");
            $table->string("status");
            $table->text("alamat_lengkap");
            $table->text("deskripsi");
            $table->integer("aduan_bulanan");
            $table->integer("aduan_tahunan");
            $table->foreignId('user_id')->constrained(
                table: 'users',
                column: 'id',
                indexName: 'pialangs_user_id',
            );
            $table->foreignId('bursa_id')->constrained(
                table: 'bursas',
                column: 'id',
                indexName: 'pialangs_bursa_id',
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pialangs');
    }
};

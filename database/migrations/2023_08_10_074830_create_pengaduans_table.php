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
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->json("terlapor")->nullable();
            $table->text("kronologi");
            $table->bigInteger("kerugian");
            $table->string("status");
            $table->string("alasan_penolakan")->nullable();
            $table->dateTime("force_close_time")->nullable();
            $table->foreignId('nasabah_id')->constrained(
                table: 'nasabahs',
                column: 'id',
                indexName: 'pengaduans_nasabah_id',
            );
            $table->foreignId('pialang_id')->constrained(
                table: 'pialangs',
                column: 'id',
                indexName: 'pengaduans_pialang_id',
            );
            $table->foreignId('bursa_id')->constrained(
                table: 'bursas',
                column: 'id',
                indexName: 'pengaduans_bursa_id',
            );
            $table->dateTime("waktu_dibuat")->nullable();
            $table->dateTime("waktu_expires_bappebti")->nullable();
            $table->dateTime("waktu_expires_pialang")->nullable();
            $table->dateTime("waktu_expires_bursa")->nullable();
            $table->dateTime("waktu_kesepakatan")->nullable();
            $table->dateTime("waktu_selesai")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};

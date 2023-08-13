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
        Schema::create('musyawarahs', function (Blueprint $table) {
            $table->id();
            $table->string("file_undangan")->nullable();
            $table->dateTime("tanggal_waktu");
            $table->text("hasil");
            $table->string("file_hasil")->nullable();
            $table->foreignId('pengaduan_id')->constrained(
                table: 'pengaduans',
                column: 'id',
                indexName: 'musyawarahs_pengaduan_id',
            );
            $table->dateTime("waktu_selesai")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('musyawarahs');
    }
};

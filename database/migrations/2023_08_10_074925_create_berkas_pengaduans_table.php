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
        Schema::create('berkas_pengaduans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengaduan_id')->constrained(
                table: 'pengaduans',
                column: 'id',
                indexName: 'berkas_pengaduans_pengaduan_id',
            );
            $table->integer("urutan");
            $table->string("filekeyname");
            $table->string("file_name");
            $table->string("file_type");
            $table->string("judul");
            $table->string("keterangan")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas_pengaduans');
    }
};

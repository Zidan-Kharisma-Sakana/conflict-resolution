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
        Schema::create('nasabahs', function (Blueprint $table) {
            $table->id();
            $table->string("nama_lengkap");
            $table->string("tempat_lahir");
            $table->date("tanggal_lahir");
            $table->string("identitas");
            $table->string("nomor_identitas");
            $table->string("gender");
            $table->string("alamat");
            $table->string("provinsi");
            $table->string("kota_kabupaten");
            $table->string("nomor_hp");
            $table->string("pekerjaan");
            $table->string("jabatan");
            $table->foreignId('user_id')->constrained(
                table: 'users',
                column: 'id',
                indexName: 'nasabahs_user_id',
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nasabahs');
    }
};

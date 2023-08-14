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
            $table->string("tempat_lahir")->nullable();
            $table->date("tanggal_lahir")->nullable();
            $table->string("identitas")->nullable();
            $table->string("nomor_identitas")->nullable();
            $table->string("gender")->nullable();
            $table->string("alamat")->nullable();
            $table->string("provinsi")->nullable();
            $table->string("kota_kabupaten")->nullable();
            $table->string("nomor_hp")->nullable();
            $table->string("pekerjaan")->nullable();
            $table->string("jabatan")->nullable();
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

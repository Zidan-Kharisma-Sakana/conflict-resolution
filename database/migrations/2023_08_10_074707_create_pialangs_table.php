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
            $table->string("status")->default('aktif');
            $table->text("alamat_lengkap")->nullable();
            $table->text("deskripsi")->nullable();
            $table->integer("aduan_bulanan")->default(0);
            $table->integer("aduan_tahunan")->default(0);
            $table->foreignId('user_id')->unique()->constrained(
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

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
        Schema::create('kesepakatans', function (Blueprint $table) {
            $table->id();
            $table->boolean("dari_musyawarah");
            $table->string("pembuat");
            $table->text("isi");
            $table->foreignId('pengaduan_id')->constrained(
                table: 'pengaduans',
                column: 'id',
                indexName: 'mediasis_pengaduan_id',
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kesepakatans');
    }
};

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
        Schema::table('pialangs', function (Blueprint $table) {
            $table->dropColumn('deskripsi');
            $table->dropColumn('aduan_bulanan');
            $table->dropColumn('aduan_tahunan');
            $table->dropColumn('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pialangs', function (Blueprint $table) {
            $table->text("deskripsi")->nullable();
            $table->integer("aduan_bulanan")->default(0);
            $table->integer("aduan_tahunan")->default(0);
            $table->string("status")->default('aktif');
        });
    }
};

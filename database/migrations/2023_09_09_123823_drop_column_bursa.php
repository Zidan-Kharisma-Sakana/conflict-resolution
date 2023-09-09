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
        Schema::table('bursas', function (Blueprint $table) {
            $table->dropColumn('deskripsi');
            $table->dropColumn('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bursas', function (Blueprint $table) {
            $table->string("status")->default("aktif");
            $table->text("deskripsi")->nullable();
        });
    }
};

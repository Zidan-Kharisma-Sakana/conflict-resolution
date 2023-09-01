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
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->boolean('is_pialang_late')->default(false);
            $table->boolean('is_bursa_late')->default(false);
            $table->boolean("is_pialang_warning_sent")->default(false);
            $table->boolean("is_bursa_warning_sent")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->dropColumn('is_pialang_late');
            $table->dropColumn('is_bursa_late');
            $table->dropColumn('is_pialang_warning_sent');
            $table->dropColumn('is_bursa_warning_sent');
        });
    }
};

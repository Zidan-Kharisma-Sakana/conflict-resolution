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
        Schema::create('bappebtis', function (Blueprint $table) {
            $table->id();
            $table->string("nip")->nullable();
            $table->foreignId('user_id')->unique()->constrained(
                table: 'users',
                column: 'id',
                indexName: 'bappebtis_user_id',
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bappebtis');
    }
};

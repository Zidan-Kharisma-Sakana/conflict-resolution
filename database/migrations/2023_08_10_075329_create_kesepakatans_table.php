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
            $table->text("isi");
            $table->string("file")->nullable();
            $table->boolean("confirmed")->default(false);
            $table->foreignId('pengaduan_id')->constrained(
                table: 'pengaduans',
                column: 'id',
                indexName: 'kesepakatans_pengaduan_id',
            );
            $table->foreignId('user_id')->constrained(
                table: 'users',
                column: 'id',
                indexName: 'kesepakatans_user_id',
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

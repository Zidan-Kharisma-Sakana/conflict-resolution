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
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->text('content');
            $table->boolean('is_warning')->default(false);
            $table->boolean('is_seen')->default(false);
            $table->string('link');
            $table->foreignId('user_id')->constrained(
                table: 'users',
                column: 'id',
                indexName: 'notifikasis_user_id',
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasis');
    }
};

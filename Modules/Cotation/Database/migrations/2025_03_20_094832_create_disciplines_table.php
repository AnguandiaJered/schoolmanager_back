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
        Schema::create('disciplines', function (Blueprint $table) {
            $table->id();
            $table->string('designation');
            $table->unsignedBigInteger('eleve_id');
            $table->unsignedBigInteger('period_id');
            $table->unsignedBigInteger('mention_id');
            $table->unsignedBigInteger('author');
            $table->foreign('eleve_id')->references('id')->on('eleves');
            $table->foreign('period_id')->references('id')->on('periodes');
            $table->foreign('mention_id')->references('id')->on('mensions');
            $table->foreign('author')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disciplines');
    }
};

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
        Schema::create('cotations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('eleve_id');
            $table->unsignedBigInteger('period_id');
            $table->unsignedBigInteger('cours_id');
            $table->bigInteger('cote');
            $table->unsignedBigInteger('author');
            $table->foreign('eleve_id')->references('id')->on('eleves');
            $table->foreign('period_id')->references('id')->on('periodes');
            $table->foreign('cours_id')->references('id')->on('cours');
            $table->foreign('author')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotations');
    }
};

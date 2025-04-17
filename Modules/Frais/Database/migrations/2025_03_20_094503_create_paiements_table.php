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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->float('montant');
            $table->string('libelle');
            $table->unsignedBigInteger('eleve_id');
            $table->unsignedBigInteger('frais_id');
            $table->unsignedBigInteger('author');
            $table->foreign('eleve_id')->references('id')->on('eleves');
            $table->foreign('frais_id')->references('id')->on('frais');
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
        Schema::dropIfExists('paiements');
    }
};

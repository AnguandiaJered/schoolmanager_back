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
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('eleve_id');
            $table->unsignedBigInteger('classe_id');
            $table->unsignedBigInteger('annee_id');
            $table->unsignedBigInteger('paiement_id');
            $table->unsignedBigInteger('author');
            $table->foreign('eleve_id')->references('id')->on('eleves');
            $table->foreign('classe_id')->references('id')->on('classes');
            $table->foreign('annee_id')->references('id')->on('annees');
            $table->foreign('paiement_id')->references('id')->on('paiements');
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
        Schema::dropIfExists('inscriptions');
    }
};

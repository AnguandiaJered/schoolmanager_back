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
        Schema::create('previsions', function (Blueprint $table) {
            $table->id();
            $table->float('montant');
            $table->unsignedBigInteger('annee_id');
            $table->unsignedBigInteger('classe_id');
            $table->unsignedBigInteger('frais_id');
            $table->unsignedBigInteger('author');
            $table->foreign('annee_id')->references('id')->on('annees');
            $table->foreign('classe_id')->references('id')->on('classes');
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
        Schema::dropIfExists('previsions');
    }
};

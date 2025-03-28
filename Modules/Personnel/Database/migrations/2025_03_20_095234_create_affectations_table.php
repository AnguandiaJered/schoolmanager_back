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
        Schema::create('affectations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enseignant_id');
            $table->unsignedBigInteger('classe_id');
            $table->unsignedBigInteger('annee_id');
            $table->date('dateAffect');
            $table->unsignedBigInteger('author');
            $table->foreign('enseignant_id')->references('id')->on('enseignants');
            $table->foreign('classe_id')->references('id')->on('classes');
            $table->foreign('annee_id')->references('id')->on('annees');
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
        Schema::dropIfExists('affectations');
    }
};

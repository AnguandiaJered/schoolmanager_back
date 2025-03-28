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
        Schema::create('enseignants', function (Blueprint $table) {
            $table->id();
            $table->string('matricule');
            $table->string('noms');
            $table->string('sexe');
            $table->date('datenaiss');
            $table->string('lieunaiss');
            $table->string('adresse');
            $table->string('etatcivil');
            $table->string('nationalite');
            $table->string('niveauEtude');
            $table->string('mail');
            $table->string('contact');
            $table->string('grade');
            $table->string('specialite');
            $table->date('finEtude');
            $table->string('ecole');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enseignants');
    }
};

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
        Schema::create('eleves', function (Blueprint $table) {
            $table->id();
            $table->string('matricule');
            $table->string('nom');
            $table->string('postnom');
            $table->string('prenom');
            $table->string('sexe');
            $table->date('datenaiss');
            $table->string('lieunaiss');
            $table->string('adresse');
            $table->string('etatcivil');
            $table->string('nationalite');
            $table->string('nomtutaire');
            $table->string('professiontutaire');
            $table->string('phonetutaire');
            $table->string('image');
            $table->unsignedBigInteger('author');
            $table->foreign('author')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eleves');
    }
};

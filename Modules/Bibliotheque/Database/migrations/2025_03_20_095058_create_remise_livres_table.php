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
        Schema::create('remise_livres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emprunt_id')->constrained();
            $table->foreignId('livre_id')->constrained();
            $table->integer('nbr_retour');
            $table->date('dateretour');
            $table->unsignedBigInteger('author');
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
        Schema::dropIfExists('remise_livres');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propriete', function (Blueprint $table) {
            $table->id();
            $table->text("qrcode");
            $table->string("nom");
            $table->string("prenom");
            $table->string("typepropriete");
            $table->string("adresse");
            $table->integer("codepostal");
            $table->string("ville");
            $table->boolean('status');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('propriete');
    }
};

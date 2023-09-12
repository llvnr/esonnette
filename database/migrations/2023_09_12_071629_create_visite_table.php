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
        Schema::create('visite', function (Blueprint $table) {
            $table->id();
            $table->integer('propriete_id');
            $table->integer('alerte_id');
            $table->dateTime('date_visite');
            $table->string('denomination');
            $table->string('telephone');
            $table->boolean('etat');
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
        Schema::dropIfExists('visite');
    }
};

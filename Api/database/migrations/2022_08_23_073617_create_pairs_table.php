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
        // Création de la table pairs pour stocker les paires de devises
        Schema::create('pairs', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('from_id')->unsigned();
            $table->foreign('from_id')->references('id')->on('currencies');
            $table->integer('to_id')->unsigned();
            $table->foreign('to_id')->references('id')->on('currencies');
            $table->decimal('rates', 12, 6);
            $table->unique(['from_id', 'to_id']);
            // nombre de fois que la conversion sera utilisée pour chaque paire de devise
            $table->integer('nbreRequest')->nullable();
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
        Schema::dropIfExists('pairs');
    }
};

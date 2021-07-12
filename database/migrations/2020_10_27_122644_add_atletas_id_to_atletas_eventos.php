<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAtletasIdToAtletasEventos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('atleta_evento', function (Blueprint $table) {
            $table->unsignedBigInteger('atletas_id');
            $table->foreign('atletas_id')->references('id')->on('atletas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('atleta_evento', function (Blueprint $table) {
            //
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtletasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atletas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('foto_carnet')->nullable();
            $table->string('nombre');
            $table->string('apellido');
            $table->enum('nacionalidad', ['V', 'E']);
            $table->string('cedula')->unique();
            $table->string('pasaporte')->nullable();
            $table->string('correo')->unique();
            $table->string('twitter')->nullable();
            $table->string('municipio');
            $table->string('parroquia');
            $table->string('telefono_movil')->unique();
            $table->string('telefono_casa');
            $table->unsignedBigInteger('pnf_id');
            $table->foreign('pnf_id')->references('id')->on('pnfs')->onDelete('cascade');
            $table->string('lapso_inscripcion');
            $table->unsignedBigInteger('disciplina_id');
            $table->foreign('disciplina_id')->references('id')->on('disciplinas')->onDelete('cascade');
            $table->date('fecha_nacimiento');
            $table->string('lugar_nacimiento');
            $table->enum('tipo_sangre', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']);
            $table->string('estatura');
            $table->unsignedInteger('talla_zapato');
            $table->string('talla_franela');
            $table->unsignedInteger('talla_short');
            $table->string('peso');
            $table->text('direccion');
            $table->text('observaciones')->nullable();
            $table->integer('active')->default(1);
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
        Schema::dropIfExists('atletas');
    }
}

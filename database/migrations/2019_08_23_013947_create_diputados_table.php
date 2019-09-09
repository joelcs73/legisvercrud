<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiputadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_diputados', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->bigIncrements('idDiputado');
            $table->string('nombre',50);
            $table->string('paterno',50);
            $table->string('materno',50);
            $table->string('extension',50)->nullable();
            $table->string('correo',50)->nullable();
            $table->string('foto',50)->nullable();
            $table->string('cvPdf',50)->nullable()->comment('Archivo PDF que contiene el curriculum vitae');
            $table->integer('idDistrito');
            $table->integer('suplenteDe')->nullable()->default(0);
            $table->integer('ordenNivel')->nullable()->default(5);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cat_diputados');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLegislaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_legislaturas', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->bigIncrements('idLegislatura');
            $table->string('clave',4);
            $table->string('nombre',50);
            $table->integer('inicio')->comment('Año de inicio');
            $table->integer('fin')->comment('Año en que finaliza');
            $table->integer('no_axos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cat_legislaturas');
    }
}

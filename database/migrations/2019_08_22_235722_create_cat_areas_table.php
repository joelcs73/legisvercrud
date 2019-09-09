<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_areas', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->bigIncrements('idArea');
            $table->string('clave',15);
            $table->string('nombre');
            $table->string('responsable')->nullable();
            $table->string('correo',100)->nullable();
            $table->string('extension',50)->nullable();
            $table->integer('areaPadre')->nullable()->default(0);
            $table->tinyInteger('apareceEnDirectorio')->default(true);
            $table->integer('idHijo');
            $table->string('archivoCurriculo')->nullable();
            $table->integer('orden');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cat_areas');
    }
}

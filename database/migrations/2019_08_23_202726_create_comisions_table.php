<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_comisiones', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->bigIncrements('idComision');
            $table->string('nombre',200);
            $table->string('tipo',1);
            $table->integer('status')->default(1);
            $table->string('icono',50)->nullable();
            $table->string('correo',50)->nullable();
            $table->string('archivoProgramaAnual',100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cat_comisiones');
    }
}

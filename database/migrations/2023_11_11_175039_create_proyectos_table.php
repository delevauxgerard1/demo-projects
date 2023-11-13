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
    Schema::create('proyectos', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('descripcion')->nullable();
        $table->bigInteger('cliente_id')->unsigned();
        $table->foreign('cliente_id')->references('id')->on('clientes');
        $table->date('fecha_inicio');
        $table->date('fecha_fin')->nullable();
        $table->bigInteger('estado_id')->unsigned()->nullable()->default(1);
        $table->foreign('estado_id')->references('id')->on('estados');
        $table->bigInteger('responsable_id')->unsigned();
        $table->foreign('responsable_id')->references('id')->on('users')->nullable();
        $table->string('activo')->default(1);
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
        Schema::dropIfExists('proyectos');
    }
};

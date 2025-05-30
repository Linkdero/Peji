<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbl_categoria', function (Blueprint $table) {
            $table->id('id_categoria');
            $table->string('categoria_detalle');
            $table->unsignedBigInteger('id_estado');
            $table->timestamps();

            $table->foreign('id_estado')
                ->references('id_estado')
                ->on('tbl_estado')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_categoria');
    }
};

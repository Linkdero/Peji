<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbl_estado', function (Blueprint $table) {
            $table->id('id_estado');
            $table->string('estado_detalle', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_estado');
    }
};

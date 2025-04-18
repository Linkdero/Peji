<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_noticia_like', function (Blueprint $table) {
            $table->foreignId('id_noticia')->constrained('tbl_noticia', 'id_noticia');
            $table->foreignId('id_usuario')->constrained('tbl_usuarios_pagina', 'id_usuario');
            $table->timestamps();

            $table->primary(['id_noticia', 'id_usuario']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_noticia_like');
    }
};

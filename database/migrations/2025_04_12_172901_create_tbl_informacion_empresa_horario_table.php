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
        Schema::create('tbl_informacion_empresa_horario', function (Blueprint $table) {
            $table->id('id_horario');
            $table->foreignId('id_empresa')->constrained('tbl_informacion_empresa', 'id_empresa');
            $table->foreignId('id_dia')->constrained('tbl_dia', 'id_dia');
            $table->time('hora_inicio');
            $table->time('hora_final');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_informacion_empresa_horario');
    }
};

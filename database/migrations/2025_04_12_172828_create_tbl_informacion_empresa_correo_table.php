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
        Schema::create('tbl_informacion_empresa_correo', function (Blueprint $table) {
            $table->id('id_correo');
            $table->foreignId('id_empresa')->constrained('tbl_informacion_empresa', 'id_empresa');
            $table->string('correo_detalle', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_informacion_empresa_correo');
    }
};

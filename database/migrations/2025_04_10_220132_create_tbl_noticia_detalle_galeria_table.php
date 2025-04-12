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
        Schema::create('tbl_noticia_detalle_galeria', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_noticia');
            $table->string('ruta', 255);

            $table->foreign('id_noticia')
                ->references('id_noticia')
                ->on('tbl_noticia')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_noticia_detalle_galeria');
    }
};

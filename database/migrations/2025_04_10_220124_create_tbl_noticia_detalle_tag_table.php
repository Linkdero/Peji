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
        Schema::create('tbl_noticia_detalle_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_noticia');
            $table->unsignedBigInteger('id_tag');

            $table->foreign('id_noticia')
                ->references('id_noticia')
                ->on('tbl_noticia')
                ->onDelete('cascade');

            $table->foreign('id_tag')
                ->references('id_tag')
                ->on('tbl_tag') // Asegúrate de tener esta tabla
                ->onDelete('cascade');

            $table->timestamps();        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_noticia_detalle_tag');
    }
};

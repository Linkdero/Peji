<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tbl_noticia', function (Blueprint $table) {
            $table->id('id_noticia');
            $table->string('noticia_titulo', 255);
            $table->text('noticia_detalle');
            $table->string('miniatura', 255)->nullable();
            $table->foreignId('id_usuario_creador')->constrained('users');
            $table->unsignedBigInteger('id_estado');
            $table->unsignedBigInteger('id_categoria'); // Nuevo campo

            $table->foreign('id_estado')
                ->references('id_estado')
                ->on('tbl_estado')
                ->onDelete('cascade');

            $table->foreign('id_categoria') // Nueva relación
                ->references('id_categoria')
                ->on('tbl_categoria')
                ->onDelete('cascade');

            $table->timestamp('fecha_creacion')->useCurrent();
            $table->timestamps();

            // Índices
            $table->index('noticia_titulo');
            $table->index('fecha_creacion');
            $table->index('id_estado');
            $table->index('id_categoria'); // Nuevo índice
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_noticia');
    }
};

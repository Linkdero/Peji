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
        Schema::create('tbl_informacion_empresa', function (Blueprint $table) {
            $table->id('id_empresa');
            $table->string('empresa_nombre', 100);
            $table->text('empresa_detalle')->nullable();
            $table->string('empresa_logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_informacion_empresa');
    }
};

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
        Schema::create('tbl_sub_modulo', function (Blueprint $table) {
            $table->id('id_sub_modulo');
            $table->foreignId('id_modulo')->constrained('tbl_modulo', 'id_modulo');
            $table->string('sub_modulo_detalle', 100);
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_sub_modulo');
    }
};

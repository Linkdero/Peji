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
        Schema::create('tbl_informacion_empresa_red_social', function (Blueprint $table) {
            $table->id('id_red');
            $table->foreignId('id_empresa')->constrained('tbl_informacion_empresa', 'id_empresa');
            $table->foreignId('id_red_social')->constrained('tbl_red_social', 'id_red_social');
            $table->string('link', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_informacion_empresa_red_social');
    }
};

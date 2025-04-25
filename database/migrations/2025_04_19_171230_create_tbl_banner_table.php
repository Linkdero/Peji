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
        Schema::create('tbl_banner', function (Blueprint $table) {
            $table->id('id_banner');
            $table->string('banner');
            $table->unsignedBigInteger('id_estado');

            $table->foreign('id_estado')
                ->references('id_estado')
                ->on('tbl_estado')
                ->onDelete('cascade');

            $table->timestamps();        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_banner');
    }
};

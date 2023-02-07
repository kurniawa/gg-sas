<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specs', function (Blueprint $table) {
            $table->id();
            $table->string('kategori',50);
            $table->string('tipe',50)->nullable();
            $table->string('kode_tipe',50)->nullable();
            $table->integer('nomor_tipe')->nullable();
            $table->string('nama')->nullable();
            $table->integer('name_id');
            $table->string('codename');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specs');
    }
};

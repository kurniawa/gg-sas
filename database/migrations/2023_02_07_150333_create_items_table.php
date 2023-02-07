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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('kategori',50);
            $table->string('tipe_perhiasan',50)->nullable();
            $table->string('jenis_perhiasan')->nullable();
            $table->string('nama');
            $table->string('nampan',50)->nullable();
            $table->string('cap',50)->nullable();
            $table->smallInteger('ukuran')->nullable();
            $table->string('range_usia',50)->nullable();
            $table->string('warna_emas',50)->nullable();
            $table->string('merek',50)->nullable();
            $table->smallInteger('plat');
            $table->smallInteger('kadar');
            $table->smallInteger('berat');
            $table->string('kondisi',50);
            $table->smallInteger('stok');
            $table->string('kode_barang',50);
            $table->string('barcode',50);
            $table->string('keterangan');
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
        Schema::dropIfExists('items');
    }
};

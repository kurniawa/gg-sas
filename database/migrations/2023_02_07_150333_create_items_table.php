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
            $table->string('tipe_barang',50);
            $table->string('tipe_perhiasan',50)->nullable();
            $table->string('jenis_perhiasan')->nullable();
            $table->string('range_usia',50);
            $table->string('warna_emas',50);
            $table->smallInteger('plat')->nullable();
            $table->string('cap',50)->nullable();
            $table->smallInteger('ukuran')->nullable();
            $table->string('nampan',50)->nullable();
            $table->string('merek',50)->nullable();
            $table->smallInteger('kadar');
            $table->enum('gol_kadar',['MUDA','BAGUS','TUA']);
            $table->smallInteger('berat'); // int/integer | 4 bytes  -2147483648 to 2147483647                    0 to 4294967295
            $table->string('kondisi',50)->nullable();
            $table->string('nama');
            $table->smallInteger('stok'); // smallint    | 2 bytes  -32768 to 32767                              0 to 65535
            $table->string('kode_item',50);
            $table->integer('barcode')->nullable();
            $table->string('keterangan')->nullable();
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

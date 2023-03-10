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
        Schema::create('pembelian_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembelian_id')->constrained()->onDelete('cascade');
            $table->foreignId('item_id')->nullable()->constrained()->onDelete('set null');
            $table->string('nama'); // sudah ada item_id tetap ada item_nama, untuk mencegah terjadinya perubahan nama item, tapi yang sudah ada di surat pastinya tidak akan berubah
            $table->string('specs');
            $table->string('kode_item', 100);
            $table->string('main_photo')->nullable();
            $table->smallInteger('jumlah')->default(1);
            $table->integer('ongkos');
            $table->integer('harga');
            $table->integer('harga_total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembelian_items');
    }
};

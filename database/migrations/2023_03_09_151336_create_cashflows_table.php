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
        Schema::create('cashflows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembelian_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('penjualan_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('nama_transaksi'); // pembelian perhiasan, penjualan perhiasan
            $table->enum('tipe',['pemasukan', 'pengeluaran']);
            $table->string('wallet',50); // tunai, bca, bri, bni, mandiri, dll
            $table->integer('jumlah');
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
        Schema::dropIfExists('cashflows');
    }
};

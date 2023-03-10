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
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat')->unique(); // id.jumlah_item.time()-1.678.420.000
            $table->bigInteger('time_key'); // id.jumlah_item.time()-1.678.420.000
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('username', 50);
            // $table->enum('tipe_pelanggan',['customer','guest']); // tipe_pelanggan sepertinya juga tidak diperlukan, selama pelanggan_id = null, maka customer belum terdaftar
            $table->foreignId('pelanggan_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('pelanggan_nama')->nullable();
            // $table->enum('guest_id',['A','B','C','D','E'])->nullable(); // guest_id tidak diperlukan di pembelian
            $table->string('keterangan')->nullable(); // jaga2 takutnya ada kondisi khusus yang ribet akhirnya perlu taro di keterangan
            $table->integer('harga_total');
            $table->integer('total_bayar');
            $table->integer('sisa_bayar');
            $table->enum('status',['belum-terjual','terjual-semua','terjual-sebagian']);
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
        Schema::dropIfExists('pembelians');
    }
};

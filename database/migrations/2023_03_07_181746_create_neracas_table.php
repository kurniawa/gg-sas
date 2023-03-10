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
        // saldo ini merupakan saldo harian, untuk dapat menampilkan saldo awal dan saldo akhir
        Schema::create('neracas', function (Blueprint $table) {
            $table->id();
            $table->string('wallet',50); // tunai, bca, bri, bni, mandiri, dll
            $table->integer('saldo');
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
        Schema::dropIfExists('neracas');
    }
};

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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('tipe_pelanggan',['customer','guest']);
            // $table->foreignId('pelanggan_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('pelanggan_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->enum('guest_id',['A','B','C','D','E'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
};

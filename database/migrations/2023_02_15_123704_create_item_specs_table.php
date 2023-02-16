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
        Schema::create('item_specs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('spec_id')->nullable()->constrained()->onDelete('SET NULL'); // Kalau spec ada yang di delete, ini ga ikut di delete
            $table->string('kategori',50);
            $table->smallInteger('jumlah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_specs');
    }
};

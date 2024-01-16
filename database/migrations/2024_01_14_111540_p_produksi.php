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
        Schema::create('p_produksi', function (Blueprint $table) {
            $table->id();
            $table->integer("jumlah_produksi")->default(0);
            $table->integer("estimasi_id");
            $table->integer("produksi_id");
            $table->string("tipe_produksi");
            $table->date('tgl_produksi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_produksi');
    }
};

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
        Schema::table('pengeluarans', function (Blueprint $table) {
            $table->index('kategori_id');
            $table->index('keterangan');
            $table->index('jumlah');
            $table->index('tanggal');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengeluarans', function (Blueprint $table) {
            $table->dropIndex('pengeluarans_kategori_id_index');
            $table->dropIndex('pengeluarans_keterangan_index');
            $table->dropIndex('pengeluarans_jumlah_index');
            $table->dropIndex('pengeluarans_tanggal_index');
            $table->dropIndex('pengeluarans_user_id_index');
        });
    }
};

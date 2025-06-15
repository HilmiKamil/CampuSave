<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Hapus foreign key constraint dari savings terlebih dahulu
        Schema::table('savings', function (Blueprint $table) {
            if (Schema::hasColumn('savings', 'saving_target_id')) {
                $table->dropForeign(['saving_target_id']);
                $table->dropColumn('saving_target_id');
            }
        });

        // Baru hapus tabel saving_targets
        Schema::dropIfExists('saving_targets');
    }

    public function down()
    {
        // Tidak diperlukan rollback karena fitur dihapus
    }
};

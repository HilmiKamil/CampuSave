<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('financial_records', function (Blueprint $table) {
            // Tambahkan kolom FK
            $table->foreignId('budget_category_id')
                ->nullable() // boleh null, opsional
                ->constrained('budget_categories') // FK ke tabel budget_categories
                ->onDelete('set null'); // jika budget category dihapus, record ini juga dihapus
        });
    }

    public function down(): void
    {
        Schema::table('financial_records', function (Blueprint $table) {
            $table->dropForeign(['budget_category_id']);
            $table->dropColumn('budget_category_id');
        });
    }
};

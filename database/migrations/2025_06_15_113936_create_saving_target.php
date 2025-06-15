<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('saving_targets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->decimal('target_amount', 12, 2);
            $table->date('target_date');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::table('savings', function (Blueprint $table) {
            $table->foreignId('saving_target_id')->nullable()->constrained('saving_targets');
        });
    }

    public function down()
    {
        Schema::table('savings', function (Blueprint $table) {
            $table->dropForeign(['saving_target_id']);
            $table->dropColumn('saving_target_id');
        });

        Schema::dropIfExists('saving_targets');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dokumentasis', function (Blueprint $table) {
            $table->dropIndex('dokumentasis_kegiatan_id_foreign');
        });

        Schema::table('dokumentasis', function (Blueprint $table) {
            $table->unsignedBigInteger('kegiatan_id')->nullable()->change();

            $table->foreign('kegiatan_id')
                ->references('id')
                ->on('schedules')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('dokumentasis', function (Blueprint $table) {
            $table->dropForeign(['kegiatan_id']);
        });

        Schema::table('dokumentasis', function (Blueprint $table) {
            $table->unsignedBigInteger('kegiatan_id')->nullable(false)->change();

            $table->index('kegiatan_id', 'dokumentasis_kegiatan_id_foreign');
        });
    }
};
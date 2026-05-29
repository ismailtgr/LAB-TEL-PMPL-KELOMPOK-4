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
        Schema::table('schedules', function (Blueprint $table) {
            $table->foreignId('schedule_category_id')
                ->nullable()
                ->after('title')
                ->constrained('schedule_categories')
                ->nullOnDelete();

            $table->dropColumn('category');
        });
    }

    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->string('category')->default('Sesi Lab')->after('title');

            $table->dropForeign(['schedule_category_id']);
            $table->dropColumn('schedule_category_id');
        });
    }
};

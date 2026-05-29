<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dokumentasis', function (Blueprint $table) {
            $table->string('judul')->after('uploaded_by');
            $table->string('file_name')->after('file_path');
            $table->string('file_type')->after('file_name');
            $table->string('mime_type')->nullable()->after('file_type');
            $table->unsignedBigInteger('file_size')->nullable()->after('mime_type');
        });
    }

    public function down(): void
    {
        Schema::table('dokumentasis', function (Blueprint $table) {
            $table->dropColumn([
                'judul',
                'file_name',
                'file_type',
                'mime_type',
                'file_size',
            ]);
        });
    }
};
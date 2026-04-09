<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('posts')) {
            return;
        }

        Schema::table('posts', function (Blueprint $table) {
            if (!Schema::hasColumn('posts', 'image_gallery_id')) {
                $table->unsignedBigInteger('image_gallery_id')->nullable()->index();
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('posts')) {
            return;
        }

        Schema::table('posts', function (Blueprint $table) {
            if (Schema::hasColumn('posts', 'image_gallery_id')) {
                $table->dropColumn('image_gallery_id');
            }
        });
    }
};


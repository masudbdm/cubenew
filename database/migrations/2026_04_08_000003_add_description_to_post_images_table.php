<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('post_images')) {
            return;
        }

        Schema::table('post_images', function (Blueprint $table) {
            if (!Schema::hasColumn('post_images', 'description')) {
                $table->string('description', 500)->nullable()->after('image_path');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('post_images')) {
            return;
        }

        Schema::table('post_images', function (Blueprint $table) {
            if (Schema::hasColumn('post_images', 'description')) {
                $table->dropColumn('description');
            }
        });
    }
};


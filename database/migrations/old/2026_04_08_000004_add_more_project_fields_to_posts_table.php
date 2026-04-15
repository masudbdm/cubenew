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
            if (!Schema::hasColumn('posts', 'number_of_bedrooms')) {
                $table->string('number_of_bedrooms')->nullable();
            }
            if (!Schema::hasColumn('posts', 'rajuk_approval_number')) {
                $table->string('rajuk_approval_number')->nullable();
            }
            if (!Schema::hasColumn('posts', 'engineer_name')) {
                $table->string('engineer_name')->nullable();
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('posts')) {
            return;
        }

        Schema::table('posts', function (Blueprint $table) {
            if (Schema::hasColumn('posts', 'number_of_bedrooms')) {
                $table->dropColumn('number_of_bedrooms');
            }
            if (Schema::hasColumn('posts', 'rajuk_approval_number')) {
                $table->dropColumn('rajuk_approval_number');
            }
            if (Schema::hasColumn('posts', 'engineer_name')) {
                $table->dropColumn('engineer_name');
            }
        });
    }
};


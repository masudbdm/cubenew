<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('website_parameters', function (Blueprint $table) {
            $table->string('count_section_title')->nullable();
            $table->text('count_section_subtitle')->nullable();
            $table->string('count_section_image')->nullable();

            $table->bigInteger('count_stat_1')->nullable();
            $table->bigInteger('count_stat_2')->nullable();
            $table->bigInteger('count_stat_3')->nullable();
            $table->bigInteger('count_stat_4')->nullable();
            $table->bigInteger('count_stat_5')->nullable();
            $table->bigInteger('count_stat_6')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('website_parameters', function (Blueprint $table) {
            $table->dropColumn([
                'count_section_title',
                'count_section_subtitle',
                'count_section_image',
                'count_stat_1',
                'count_stat_2',
                'count_stat_3',
                'count_stat_4',
                'count_stat_5',
                'count_stat_6',
            ]);
        });
    }
};


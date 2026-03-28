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
        Schema::table('website_parameters', function (Blueprint $table) {
            $table->string('customer_review_link')->nullable();
            $table->string('landowner_review_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('website_parameters', function (Blueprint $table) {
            $table->dropColumn(['customer_review_link', 'landowner_review_link']);
        });
    }
};

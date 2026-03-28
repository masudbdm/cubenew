<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_documents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('donation_application_id')->unsigned()->nullable();
            $table->string('document_type')->nullable();
            $table->string('file_name')->nullable();
            $table->bigInteger('addedby_id')->unsigned()->nullable();
            $table->bigInteger('editedby_id')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donation_documents');
    }
}

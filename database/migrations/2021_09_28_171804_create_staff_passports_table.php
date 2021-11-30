<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffPassportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_passports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->references('id')->on('staff');
            $table->string('document_no')->nullable();
            $table->string('country_of_issue')->nullable();
            $table->date('date_of_issue')->nullable();
            $table->date('date_of_expiry')->nullable();
            $table->string('visa_need')->nullable();
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
        Schema::dropIfExists('staff_passports');
    }
}

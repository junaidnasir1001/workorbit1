<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffHealthInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_health_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->references('id')->on('staff');
            $table->string("can_examined")->nullable();
            $table->string("has_condition")->nullable();
            $table->string("need_care")->nullable();
            $table->string("disabled_no")->nullable();
            $table->string("absent_days_in_last_two_years")->nullable();
            $table->text("additional_comment")->nullable();
            $table->string("heart_disease")->nullable();
            $table->string("diabetes")->nullable();
            $table->string("glasses")->nullable();
            $table->string("other_illness")->nullable();
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
        Schema::dropIfExists('staff_health_information');
    }
}

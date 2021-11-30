<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_trainings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->references('id')->on('staff');
            $table->string("training_provider_name")->nullable();
            $table->string("course_name")->nullable();
            $table->string("certificate_obtained")->nullable();
            $table->date("start_date")->nullable();
            $table->date("end_date")->nullable();
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
        Schema::dropIfExists('staff_trainings');
    }
}

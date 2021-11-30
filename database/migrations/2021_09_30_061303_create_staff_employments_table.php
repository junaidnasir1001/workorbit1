<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffEmploymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_employments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->references('id')->on('staff');
            $table->string("company_name")->nullable();
            $table->string("job_title")->nullable();
            $table->text("address")->nullable();
            $table->string("postal_code")->nullable();
            $table->string("contact_person")->nullable();
            $table->string("contact_phone")->nullable();
            $table->string("email")->nullable();
            $table->date("start_date")->nullable();
            $table->date("end_date")->nullable();
            $table->longText("reason_for_leaving")->nullable();
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
        Schema::dropIfExists('staff_employments');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_id')->references('id')->on('sites');
            $table->foreignId('site_type_id')->references('id')->on('site_types');
            $table->time('time_in')->nullable();
            $table->time('time_out')->nullable();
            $table->time('break_time_start')->nullable();
            $table->time('break_time_end')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->json('working_days')->nullable();
            $table->longText('instructions');
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
        Schema::dropIfExists('shifts');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shift_staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shift_id')->references('id')->on('shifts');
            $table->foreignId('staff_id')->references('id')->on('staff');
            $table->string('pay_rate')->nullable();
            $table->enum('shift_schedule', ['default', 'custom'])->default('default');
            $table->time('time_in')->nullable();
            $table->time('time_out')->nullable();
            $table->time('break_time_start')->nullable();
            $table->time('break_time_end')->nullable();
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
        Schema::dropIfExists('shift_staff');
    }
}

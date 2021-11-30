<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffAppearancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_appearances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->references('id')->on('staff');
            $table->string('trousers_size')->nullable();
            $table->string('skirt_size')->nullable();
            $table->string('hips')->nullable();
            $table->string('hair_color')->nullable();
            $table->string('jacket_size')->nullable();
            $table->string('height')->nullable();
            $table->string('bust')->nullable();
            $table->string('chest')->nullable();
            $table->string('collar')->nullable();
            $table->string('waist')->nullable();
            $table->string('inside_leg')->nullable();
            $table->string('eye_colour')->nullable();
            $table->string('shoe_size')->nullable();
            $table->string('hat_size')->nullable();
            $table->string('weight')->nullable();
            $table->string('hair_length')->nullable();
            $table->string('facial_length')->nullable();
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
        Schema::dropIfExists('staff_appearances');
    }
}

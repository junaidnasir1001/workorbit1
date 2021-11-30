<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffPersonalReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_personal_references', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->references('id')->on('staff');
            $table->string("name")->nullable();
            $table->string("email")->nullable();
            $table->text("address")->nullable();
            $table->string("postal_code")->nullable();
            $table->string("phone")->nullable();
            $table->string("occupation")->nullable();
            $table->string("how_long_know")->nullable();
            $table->string("relation")->nullable();
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
        Schema::dropIfExists('staff_personal_references');
    }
}

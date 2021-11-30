<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitePayRateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_pay_rate_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_id')->references('id')->on('sites');
            $table->foreignId('designation_id')->references('id')->on('designations');
            $table->string('rate');
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
        Schema::dropIfExists('site_pay_rate_cards');
    }
}

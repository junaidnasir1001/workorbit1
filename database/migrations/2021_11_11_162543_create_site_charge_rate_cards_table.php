<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteChargeRateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_charge_rate_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_id')->references('id')->on('sites');
            $table->foreignId('site_type_id')->references('id')->on('site_types');
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
        Schema::dropIfExists('site_charge_rate_cards');
    }
}

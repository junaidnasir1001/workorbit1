<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\StaffVetting;

class CreateStaffVettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_vettings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->references('id')->on('staff');
            $table->foreignId('vetting_id')->references('id')->on('vettings');
            $table->text('file_path');
            $table->text('note')->nullable();
            $table->enum('status', [
                StaffVetting::VERIFIED,
                StaffVetting::NOT_VERIFIED,
                StaffVetting::REJECTED,
            ])->default(StaffVetting::NOT_VERIFIED);
            $table->foreignId('vetting_by')->references('id')->on('admins');
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
        Schema::dropIfExists('staff_vettings');
    }
}

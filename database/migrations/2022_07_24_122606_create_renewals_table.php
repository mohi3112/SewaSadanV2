<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renewals', function (Blueprint $table) {
            $table->id();
            $table->string('SSID');
            $table->string('SlipNo');
            $table->string('GuestName');
            $table->string('FatherName');
            $table->string('PatientName');
            $table->string('Room');
            $table->string('Bed');
            $table->string('RoomType');
            $table->string('RenewDate');
            $table->string('RenewBy');
            $table->string('RenewalAmount');
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
        Schema::dropIfExists('renewals');
    }
};

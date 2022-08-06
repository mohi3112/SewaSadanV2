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
        Schema::create('beddings', function (Blueprint $table) {
            $table->id();
            $table->string('BookingID')->unique();
            $table->string('SSID');
            $table->string('SlipNo');
            $table->string('GuestName');
            $table->string('FatherName');
            $table->string('Room');
            $table->string('Bed');
            $table->string('RoomType');
            $table->string('AssetId');
            $table->string('AssetName');
            $table->string('IssuedDate');
            $table->string('IssuedBy');
            $table->string('ReturnDate');
            $table->string('ReturnedBy');
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
        Schema::dropIfExists('beddings');
    }
};

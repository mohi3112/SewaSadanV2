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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('RoomNo');
            $table->string('BedNo');
            $table->string('RoomType');
            $table->string('RoomRent');
            $table->string('CurrentStatus');
            $table->string('CurrentGuest');
            $table->string('BookingId');
            $table->string('ArrivalTime');
            $table->string('ValidUpto');
            $table->string('RoomAssets');
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
        Schema::dropIfExists('rooms');
    }
};

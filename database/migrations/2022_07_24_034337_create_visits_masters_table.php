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
        Schema::create('visits_masters', function (Blueprint $table) {
            $table->id();
            $table->string('BookingID')->unique();
            $table->string('SSID');
            $table->string('GuestName');
            $table->string('FatherName');
            $table->string('Mobile');
            $table->string('IDNumber');
            $table->string('PatientName');
            $table->string('MRDNO');
            $table->string('PatientAdmtDate');
            $table->string('Room');
            $table->string('Bed');
            $table->string('RoomType');
            $table->string('CheckinDate');
            $table->string('CheckinBy');
            $table->string('SlipNo');
            $table->string('Status');
            $table->string('VoucherNo');
            $table->string('CheckoutDate');
            $table->string('CheckoutBy');
            $table->string('Donation');
            $table->string('DonationNo');
            $table->string('BeddingStatus');
            $table->string('BeddingIssueDate');
            $table->string('BeddingIssuedBy');
            $table->string('BeddingReturnDate');
            $table->string('BeddingRetunedBy');
            
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
        Schema::dropIfExists('visits_masters');
    }
};

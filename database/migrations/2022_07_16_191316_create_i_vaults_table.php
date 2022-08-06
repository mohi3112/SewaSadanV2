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
        Schema::create('i_vaults', function (Blueprint $table) {
            $table->id();
            $table->string('SSID')->unique();
            $table->string('Name');
            $table->string('Mobile')->unique();
            $table->string('DrivingLicence')->unique();
            $table->string('VoterCard')->unique();
            $table->string('AadharCard')->unique();
            $table->string('RationCard')->unique();
            $table->string('Passport')->unique();
            $table->string('GovtID')->unique();
            $table->string('Others')->unique();
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
        Schema::dropIfExists('i_vaults');
    }
};

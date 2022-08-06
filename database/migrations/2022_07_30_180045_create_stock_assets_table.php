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
        Schema::create('stock_assets', function (Blueprint $table) {
            $table->id();
            $table->string('AssetName');
            $table->string('CategoryID');
            $table->string('CategoryName');
            $table->string('LocationID');
            $table->string('LocationName');
            $table->string('VendorID');
            $table->string('VendorName');
            $table->string('Status');
            $table->string('StockType');
            $table->string('AssignedTo');
            $table->string('Rate');
            $table->string('Measures');
            $table->string('Quality');
            $table->string('Color');
            $table->string('EntryDate');
            $table->string('EntryBy');
            $table->string('discontinued');
            $table->string('discontinuedReason');
            $table->string('discontinuedDate');
            $table->string('discontinuedNote');
            $table->string('discontinuedBy');
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
        Schema::dropIfExists('stock_assets');
    }
};

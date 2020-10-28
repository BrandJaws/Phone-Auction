<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_order_items', function (Blueprint $table) {
            $table->id();
            $table->integer('sell_order_id');
            $table->integer('device_id');
            $table->integer('device_model_id');
            $table->integer('network_carrier_id');
            $table->integer('model_quote_id');
            $table->string('promoCode')->nullable();
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
        Schema::dropIfExists('sell_order_items');
    }
}

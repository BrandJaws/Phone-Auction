<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('model_quote_id');
            $table->string('name');
            $table->string('email');
            $table->string('address');
            $table->string('city');
            $table->string('province');
            $table->string('postalCode');
            $table->string('phone');
            $table->boolean('onlyShippingLabel');
            $table->string('paymentMethod');
            $table->string('paymentEmail');
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
        Schema::dropIfExists('sell_orders');
    }
}

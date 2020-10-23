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
            // $table->integer('model_quote_id');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('email');
            $table->string('address');
            $table->string('city');
            $table->string('province');
            $table->string('postalCode');
            $table->string('phone');
            $table->boolean('onlyShippingLabel');
            $table->string('paymentMethod');
            $table->string('paymentEmail');
            $table->string('promoCode')->nullable();
            $table->decimal('netTotal', 10, 2)->default(0);
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

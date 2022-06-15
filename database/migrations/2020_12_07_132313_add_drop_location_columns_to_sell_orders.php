<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDropLocationColumnsToSellOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sell_orders', function (Blueprint $table) {
            $table->boolean('selfDropToLocation')->after('id')->nullable();
            $table->integer('drop_location_id')->after('selfDropToLocation')->nullable();
            $table->string('firstName')->nullable()->change();
            $table->string('lastName')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('city')->nullable()->change();
            $table->string('province')->nullable()->change();
            $table->string('postalCode')->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->boolean('onlyShippingLabel')->nullable()->change();
            $table->string('paymentMethod')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sell_orders', function (Blueprint $table) {
            $table->dropColumn('selfDropToLocation');
            $table->dropColumn('drop_location_id');
        });
    }
}

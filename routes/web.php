<?php

use App\Http\Livewire\Pages\Dashboard\Dashboard;
use App\Http\Livewire\Pages\Dashboard\Devices\DeviceModels\DeviceModels;
use App\Http\Livewire\Pages\Dashboard\Devices\DeviceModels\EditDeviceModel;
use App\Http\Livewire\Pages\Dashboard\Devices\DeviceModels\ModelQuotes\EditModelQuote;
use App\Http\Livewire\Pages\Dashboard\Devices\DeviceModels\ModelQuotes\ModelQuotes;
use App\Http\Livewire\Pages\Dashboard\Devices\Devices;
use App\Http\Livewire\Pages\Dashboard\Devices\EditDevice;
use App\Http\Livewire\Pages\Dashboard\NetworkCarriers\EditNetworkCarrier;
use App\Http\Livewire\Pages\Dashboard\NetworkCarriers\NetworkCarriers;
use App\Http\Livewire\Pages\Home;
use App\Http\Livewire\Pages\Dashboard\DeviceStates\DeviceStates;
use App\Http\Livewire\Pages\Dashboard\DeviceStates\EditDeviceState;
use App\Http\Livewire\Pages\Dashboard\SellOrders\SellOrders;
use App\Http\Livewire\Pages\Dashboard\SellOrders\ViewSellOrder;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', Home::class)->name('home');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', Dashboard::class)->name('dashboard');
Route::prefix('dashboard')->name('dashboard')->middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/', Dashboard::class);

    Route::prefix('devices')->name('.devices')->group(function () {
        Route::get('/', Devices::class);
        Route::get('/{device_id}', EditDevice::class)->name('.edit');
        Route::prefix('/{device_id}/models')->name('.models')->group(function () {
            Route::get('/', DeviceModels::class);
            Route::get('/{device_model_id}', EditDeviceModel::class)->name('.edit');
            // Route::prefix('/{device_model_id}/quotes')->name('.quotes')->group(function () {
            //     Route::get('/', ModelQuotes::class);
            //     Route::get('/{model_quote_id}', EditModelQuote::class)->name('.edit');
            // });
        });
    });

    Route::prefix('network-carriers')->name('.network-carriers')->group(function () {
        Route::get('/', NetworkCarriers::class);
        Route::get('/{network_carrier_id}', EditNetworkCarrier::class)->name('.edit');

    });

    Route::prefix('device-states')->name('.device-states')->group(function () {
        Route::get('/', DeviceStates::class);
        Route::get('/{device_state_id}', EditDeviceState::class)->name('.edit');
    });

    Route::prefix('sell-orders')->name('.sell-orders')->group(function () {
        Route::get('/', SellOrders::class);
        Route::get('/{sell_order_id}', ViewSellOrder::class)->name('.view');
    });



});

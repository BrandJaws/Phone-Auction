<?php

use App\Models\Device;
use App\Models\DeviceModel;
use App\Models\DeviceState;
use App\Models\ModelQuote;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhonesDataImplementationTable extends Migration
{
    public $deviceName,$phones,$phoneModels,$deviceModel;
    public $totalIndex = 5;
    public $modelState,$device;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $path = public_path() . '/csv/phones.csv';
        $data = array_map('str_getcsv', file($path));
        if (Device::with('models')->count() == 0) {
            foreach ($data as $key => $singleLineData) {
                if ($key > 0) {
                    if ($singleLineData[0] !== '') {
                        $csv_phones_data = new Device();
                        $csv_phones_data->name = $singleLineData[0];
                        $csv_phones_data->save();
                        $this->phones = $csv_phones_data;
                    }
                    $csv_phones_models_data = new DeviceModel();
                    $csv_phones_models_data->device_id = $this->phones->id;
                    $csv_phones_models_data->name = $singleLineData[1];
                    $csv_phones_models_data->order = $csv_phones_models_data->count() + 1;
                    $csv_phones_models_data->save();
                    $this->deviceModel = $csv_phones_models_data;
                    $deviceState = DeviceState::all();
                    foreach ($deviceState as $keyIndex => $singleDeviceState) {
                        $csv_phones_quotes = new ModelQuote();
                        $csv_phones_quotes->device_model_id = $csv_phones_models_data->id;
                        $csv_phones_quotes->device_state_id = $singleDeviceState->id;
                        $csv_phones_quotes->quote_price = $singleLineData[$keyIndex + 2];
                        $csv_phones_quotes->save();
                    }
                } else {
                    for ($index = 2; $index <= $this->totalIndex; $index++) {
                        $csv_phones_models_states = new DeviceState();
                        $csv_phones_models_states->condition = $singleLineData[$index];
                        $csv_phones_models_states->features = ['','',''];
                        $csv_phones_models_states->save();
                        $this->modelState = $csv_phones_models_states;
                    }
                }
            }
        }
//        Schema::create('phones_data_implementation', function (Blueprint $table) {
//            $table->id();
//            $table->timestamps();
//        });
    }

}

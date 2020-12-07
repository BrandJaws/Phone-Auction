<?php

namespace Database\Seeders;

use App\Models\DropLocation;
use Illuminate\Database\Seeder;

class DropLocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = [
            [
                "name" => "Timberlands",
                "address" => "#440 500 Timberlands Drive, Red Deer, Alberta T4P 0Z4",
                "phone" => "(403) 314-4400"
            ],
            [
                "name" => "Parkland Mall",
                "address" => "6359 50th Ave, Red Deer, Alberta T4N 6H3",
                "phone" => "(587) 802-1902"
            ]
        ];
        foreach($locations as $location){
            $dropLocation = DropLocation::create($location);
        }


    }
}

<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = User::create([
            "name" => "Super Admin",
            "email" => "admin@mobijacks.com",
            "password" => Hash::make('1jc_2kC@vvk)9AsC_sA$$', ['rounds' => 12,]),
        ]);

    }
}

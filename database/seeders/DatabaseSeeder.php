<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SettingSeeder::class,
            UserSeeder::class
        ]);

        // DB::table('users')->insert([
        //     'name' => "Admin",
        //     'email' => "admin@admin.com",
        //     'password' => Hash::make('admin'),
        // ]);
    }
}

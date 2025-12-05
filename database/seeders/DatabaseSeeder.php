<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('passport:install');

        $this->call([
            RolesAndPermissionsTableSeeder::class,
            UserSeeder::class,
            // CustomerSeeder::class,
            // CategorySeeder::class,
            // BrandSeeder::class,
            // ProductSeeder::class,
            // OrderSeeder::class
        ]);

    }
}

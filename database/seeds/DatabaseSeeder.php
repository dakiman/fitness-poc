<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call('UserTypeTableSeeder');
         $this->call('UsersTableSeeder');
//         $this->call(App\seeds\UsersTableSeeder::class);
    }
}

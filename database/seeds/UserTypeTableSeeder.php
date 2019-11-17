<?php

use Illuminate\Database\Seeder;
use App\UserType;
class UserTypeTableSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user_types = [
            ['user_type' => 'admin'],
            ['user_type' => 'user'],
            ['user_type' => 'coach']
            ];

            foreach($user_types as $user_type)
            {
                UserType::create($user_type);
            }
    }
}

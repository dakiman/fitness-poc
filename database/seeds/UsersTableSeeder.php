<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 5)->create();


        //Coach seeder
        factory(App\User::class, 5)->create([
            'user_type_id' => '2',
        ]);

        factory(App\User::class)->create([
            'name' => 'Urko',
            'email' => 'urko@magnus.com',
            'user_type_id' => '2'
        ]);

        factory(App\User::class)->create([
            'name' => 'Prosechen Vezhbach',
            'email' => 'vezhbach@magnus.com',
            'user_type_id' => '1'
        ]);

    }
}

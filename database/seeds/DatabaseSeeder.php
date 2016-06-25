<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => "Eleve",
        ]);

        DB::table('roles')->insert([
            'name' => "Prof",
        ]);

        DB::table('users')->insert([
            'firstname' => "John",
            'lastname' => "Doe",
            'mail' => "utilisateur@mail.com",
            'role_id' => "1",
            'password' => bcrypt('secret'),
            'avatar'=> 'default.png',
        ]);

        DB::table('users')->insert([
            'firstname' => "Professeur",
            'lastname' => "Tournesol",
            'mail' => "tournesol@mail.com",
            'role_id' => "2",
            'password' => bcrypt('secret'),
            'avatar'=> 'default.png',
        ]);
    }
}

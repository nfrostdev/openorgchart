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
        factory(\App\User::class, 24)->create();
        factory(\App\Department::class, 10)->create();
        factory(\App\Team::class, 50)->create();
        factory(\App\Employee::class, 250)->create();
    }
}

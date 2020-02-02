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
        factory(\App\Employee::class, 250)->create()->each(function ($employee) {
            // 1 in 10 employees may not have a supervisor.
            if (rand(1, 10) !== 10) {
                $employee->update([
                    'supervisor_id' => \App\Employee::all()
                        ->where('id', '!=', $employee->id)
                        ->random()
                        ->id
                ]);
            }
        });
    }
}

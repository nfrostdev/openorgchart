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
        factory(\App\Department::class, 5)->create()->each(function ($department) {
            factory(\App\Team::class, rand(1, 3))->create([
                'department_id' => $department->id,
            ]);
        });
        factory(\App\Employee::class, 50)->create();

        // Assign department and team leaders after employees are seeded.
        \App\Department::all()->each(function ($department) {
            $department->update([
                'leader_id' => \App\Employee::all()->random()->id
            ]);

            $department->teams->each(function ($team) {
                $team->update([
                    'leader_id' => \App\Employee::all()
                        ->where('team_id', $team->id)
                        ->random()->id
                ]);
            });
        });
    }
}

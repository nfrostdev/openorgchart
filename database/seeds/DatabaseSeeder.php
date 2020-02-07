<?php

use App\Department;
use App\Employee;
use App\Team;
use App\User;
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
        factory(User::class, 19)->create();
        factory(Department::class, 20)->create()->each(function ($department) {
            factory(Team::class, rand(1, 5))->create([
                'department_id' => rand(0, 7) ? $department->id : null,
            ]);
        });
        factory(Employee::class, 500)->create();

        // Assign department and team leaders after employees are seeded.
        Department::all()->each(function ($department) {
            if (rand(0, 7)) {
                $department->update([
                    'leader_id' => Employee::all()->random()->id
                ]);
            }

            $department->teams->each(function ($team) {
                if (rand(0, 7)) {
                    $team->update([
                        'leader_id' => Employee::all()
                            ->where('team_id', $team->id)
                            ->random()->id
                    ]);
                }
            });
        });
    }
}

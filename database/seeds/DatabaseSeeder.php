<?php

use App\Department;
use App\Employee;
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
        factory(User::class, rand(1, 19))->create();
        factory(Department::class, rand(2, 5))->create();
        factory(Employee::class, rand(50, 100))->create();

        Department::all()->each(function ($department) {
            $leader = Employee::where('department_id', $department->id)->get()->random();

            $department->update([
                'employee_id' => $leader->id
            ]);

            Employee::where('department_id', $department->id)
                ->where('id', '!=', $leader->id)
                ->limit(rand(1, 5))
                ->get()
                ->each(function ($supervisor) use ($department, $leader) {
                    $supervisor->update([
                        'supervisor_id' => $leader->id
                    ]);

                    Employee::where('department_id', $department->id)
                        ->where('id', '!=', $leader->id)
                        ->where('id', '!=', $supervisor->id)
                        ->limit(rand(1, 5))
                        ->get()
                        ->each(function ($employee) use ($supervisor) {
                            $employee->update([
                                'supervisor_id' => $supervisor->id
                            ]);
                        });
                });

        });
    }
}

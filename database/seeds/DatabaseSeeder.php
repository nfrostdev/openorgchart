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
        factory(Department::class, rand(5, 20))->create();
        factory(Employee::class, 1000)->create();

        Department::all()->each(function ($department) {
            $leader = Employee::where('department_id', $department->id)->get()->random();

            $department->update([
                'employee_id' => $leader->id
            ]);

            Employee::where('department_id', $department->id)
                ->where('id', '!=', $leader->id)
                ->limit(rand(2, 4))
                ->inRandomOrder()
                ->get()
                ->each(function ($supervisor) use ($department, $leader) {
                    $supervisor->update([
                        'supervisor_id' => $leader->id
                    ]);

                    Employee::where('department_id', $department->id)
                        ->where('id', '!=', $leader->id)
                        ->where('id', '!=', $supervisor->id)
                        ->limit(rand(0, 4))
                        ->inRandomOrder()
                        ->get()
                        ->each(function ($employee) use ($department, $leader, $supervisor) {
                            $employee->update([
                                'supervisor_id' => $supervisor->id
                            ]);

                            Employee::where('department_id', $department->id)
                                ->where('id', '!=', $leader->id)
                                ->where('id', '!=', $supervisor->id)
                                ->where('id', '!=', $employee->id)
                                ->limit(rand(0, 3))
                                ->inRandomOrder()
                                ->get()
                                ->each(function ($s_employee) use ($employee) {
                                    $s_employee->update([
                                        'supervisor_id' => $employee->id
                                    ]);
                                });
                        });
                });
        });
    }
}

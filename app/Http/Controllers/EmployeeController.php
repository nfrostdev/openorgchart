<?php

namespace App\Http\Controllers;

use App\Employee;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('employees.index', ['employees' => Employee::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('employees.create', [
            'employees' => Employee::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'title' => 'required|string',
            'supervisor_id' => 'nullable|exists:employees,id'
        ]);

        Employee::create($request->all());

        return redirect()->route('employees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Employee $employee
     * @return View
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', [
            'employee' => $employee,
            'employees' => Employee::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Employee $employee
     * @return RedirectResponse
     */
    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'title' => 'required|string',
            'supervisor_id' => 'nullable|exists:employees,id'
        ]);

        // Get a list of disallowed supervisors from this department.
        $disallowed_supervisor_ids = \App\Department::recursiveEmployeeCheck($employee)->map(function ($employee) {
            return $employee->id;
        })->toArray();

        // Filter the employees to see who is assignable.
        $supervisors = Employee::all()->map(function ($supervisor) use ($disallowed_supervisor_ids) {
            return !in_array($supervisor->id, $disallowed_supervisor_ids) ? $supervisor : null;
        })->reject(function ($employee) {
            return $employee === null;
        });

        // If the supervisor selection is in the list of allowable supervisors, proceed.
        if ($supervisors->contains('id', $data['supervisor_id'])) {
            $employee->update($data);
            return redirect()->route('employees.index');
        }

        return redirect()->back()->withErrors(['supervisor_id' => 'That supervisor selection is invalid for this employee.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Employee $employee
     * @return RedirectResponse
     */
    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e);
        }
        return redirect()->route('employees.index');
    }
}

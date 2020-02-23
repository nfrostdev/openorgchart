<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    public function __construct()
    {
        if (env('AUTHENTICATION_REQUIRED')) {
            $this->middleware('auth', ['only' => 'show']);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $departments = Department::orderBy('name');

        $filter = $request->input('filter');

        if ($filter) {
            $departments = $departments->where('name', 'like', '%' . $filter . '%');
        }

        return view('departments.index', ['departments' => $departments->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('departments.create', ['employees' => Employee::all()]);
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
            'name' => 'required|string',
            'employee_id' => 'nullable|exists:employees,id'
        ]);

        Department::create($request->all());

        return redirect()->route('departments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Department $department
     * @return View
     */
    public function show(Department $department)
    {
        return view('departments.show', [
            'department' => $department,
            'departments' => Department::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Department $department
     * @return View
     */
    public function edit(Department $department)
    {
        return view('departments.edit', [
            'department' => $department,
            'employees' => Employee::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Department $department
     * @return RedirectResponse
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string',
            'employee_id' => 'nullable|exists:employees,id'
        ]);

        $department->update($request->all());

        return redirect()->route('departments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Department $department
     * @return RedirectResponse
     */
    public function destroy(Department $department)
    {
        try {
            $department->delete();
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e);
        }
        return redirect()->route('departments.index');
    }
}

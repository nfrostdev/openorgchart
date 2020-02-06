<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee;
use App\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Exception;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('teams.index', ['teams' => Team::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('teams.create', [
            'departments' => Department::all(),
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
            'name' => 'required|string',
            'department_id' => 'nullable|exists:departments,id',
            'leader_id' => 'nullable|exists:employees,id'
        ]);

        Team::create($request->all());

        return redirect()->route('teams.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Team $team
     * @return View
     */
    public function show(Team $team)
    {
        // TODO: Is this route worth it?
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Team $team
     * @return View
     */
    public function edit(Team $team)
    {
        return view('teams.edit', [
            'team' => $team,
            'departments' => Department::all(),
            'employees' => Employee::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Team $team
     * @return RedirectResponse
     */
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required|string',
            'department_id' => 'nullable|exists:departments,id',
            'leader_id' => 'nullable|exists:employees,id'
        ]);

        $team->update($request->all());

        return redirect()->route('teams.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Team $team
     * @return RedirectResponse
     */
    public function destroy(Team $team)
    {
        try {
            $team->delete();
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e);
        }
        return redirect()->route('teams.index');
    }
}

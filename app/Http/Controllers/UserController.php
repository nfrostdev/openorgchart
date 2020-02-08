<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('users.index', ['users' => User::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('users.create', ['roles' => Role::orderByDesc('id')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'roles' => Role::orderByDesc('id')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
            'role_id' => 'sometimes|nullable|exists:roles,id'
        ]);

        $user->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name']
        ]);

        // The default administrator cannot have a role change.
        if ($user->id !== 1 && isset($data['role_id'])) {
            $user->update(['role_id' => $data['role_id']]);
        }

        // See if this update includes an email that is different.
        if ($request->input('email') !== $user->email) {
            // Make sure it isn't already used.
            $request->validate(['email' => 'required|string|email|max:255|unique:users']);
            $user->update(['email' => $request->input('email')]);
        }

        // If a password is enforced, update it.
        if ($data['password']) {
            $user->update([
                'password' => Hash::make($data['password'])
            ]);
        }

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user)
    {
        // The user cannot delete the default administrator or themself.
        if ($user->id !== 1 && $user->id !== Auth::user()->id) {
            try {
                $user->delete();
            } catch (Exception $e) {
                return redirect()->back()->withErrors($e);
            }
        }
        return redirect()->route('users.index');
    }
}

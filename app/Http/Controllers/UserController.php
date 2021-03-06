<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $users = User::orderBy('last_name');

        $filter = $request->input('filter');

        if ($filter) {
            $users = $users->where('first_name', 'like', '%' . $filter . '%')
                ->orWhere('last_name', 'like', '%' . $filter . '%')
                ->orWhere('email', 'like', '%' . $filter . '%');
        }

        return view('users.index', ['users' => $users->paginate(10)]);
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
            'role_id' => 'sometimes|nullable|exists:roles,id'
        ]);

        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        if (isset($data['role_id'])) {
            $user->update(['role_id' => $data['role_id']]);
        }

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
     * @return View|void
     */
    public function edit(User $user)
    {
        $user_is_administrator = Auth::user()->hasRole('Administrator');

        if ($user->id !== Auth::user()->id && !$user_is_administrator) {
            return abort(403);
        }

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
     * @return RedirectResponse|void
     */
    public function update(Request $request, User $user)
    {
        $user_is_administrator = Auth::user()->hasRole('Administrator');
        if ($user->id !== Auth::user()->id && !$user_is_administrator) {
            return abort(403);
        }

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

        // The default administrator cannot have a role change via this interface.
        // A user that isn't an admin cannot change their own role.
        if (isset($data['role_id']) && $user_is_administrator && $user->id !== 1) {
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
            $user->update(['password' => Hash::make($data['password'])]);
        }

        if ($user_is_administrator) {
            return redirect()->route('users.index');
        }

        return redirect()->route('index');
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

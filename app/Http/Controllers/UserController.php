<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index',compact('users'));
    }
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit',compact('roles','user'));
    }
    public function update(Request $request,User $user)
    {
        $validated = $request->validate([
            'name'      => 'required',
            'email'     => 'required',
            'password'  => 'nullable|min:6',
            'role' => 'required|exists:roles,name',
        ]);

        $user->update([
            'name'   => $validated['name'],
            'email' => $validated['email'],
        ]);

        if ($request->filled('password'))
        {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        $user->syncRoles($request->role);

        return redirect()->back()->with('success','User edit successfully!');

    }
    public function create()
    {
        $roles = Role::all();
        return view('users.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password'  => 'required',
            'role'     => 'required|exists:roles,name',
        ]);

        $user = User::create([
           'name'   => $data['name'],
           'email'  => $data['email'],
            'password'  => $data['password'],
        ]);
        $user->assignRole($data['role']);
        return redirect()->back()->with('success','User successfully create.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success','User delete successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param \Spatie\Permission\Models\Role $role
     * @return \Illuminate\Container\Container|\Illuminate\Container\TClass|object
     */
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('roles.index',compact('roles','permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required',
            'guard_name'    => 'nullable|string',
        ]);

        $role = Role::create([
            'name' => $data['name'],
            'guard_name' => $data['guard_name'] ?? 'web',
        ]);

        $role->syncPermissions($request->permissions ?? []);

        return redirect()->back()->with('success','Role Store Successfully');
    }

    /**
     * Display the specified resource.
     * @param Role $role
     * @return \Illuminate\Container\Container|\Illuminate\Container\TClass|object
     */

    public function show(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.view',compact('role','permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Role $role
     * @param Permission $permission
     * @return \Illuminate\Container\Container|\Illuminate\Container\TClass|object
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Role $role
     * @return
     */

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name'  => 'required',
            'guard_name' => 'nullable|string'
        ]);

        $role->update([
            'name'  => $validated['name'],
            'guard_name'    => $validated['guard_name'] ?? 'web',
        ]);
        $role->syncPermissions($request->permissions ?? []);
        return redirect()->route('roles.index')->with('success','Role update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     * @param Role $role
     * @return
     */
    public function destroy(Role $role)
    {

        $role->delete();
        return redirect()->back()->with('success','Role delete successfully');
    }
}

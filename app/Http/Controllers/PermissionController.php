<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::get();

        return view('permissions.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string|unique:permissions,name',
            'guard_name'    =>  'nullable|string',
        ]);

        $permission = Permission::create([
            'name'          => $data['name'],
            'guard_name'    => $data['guard_name'] ?? 'web',
        ]);

        return redirect()->back()->with('success','Permission created successfully!');
    }

    /**
     * Display the specified resource.
     * @param Permission $permission
     */
    public function show(Permission $permission)
    {
        return view('permissions.view',compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Permission $permission
     */
    public function edit(Permission $permission)
    {
        return view('permissions.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Permission $permission
     */

    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name'      =>  'required|string|unique:permissions,name,' . $permission->id,
            'guard_name' => 'nullable|string',
        ]);

        $permission->update([
           'name'   => $validated['name'],
           'guard_name' => $validated['guard_name'] ?? 'web',
        ]);

        return redirect()->route('permissions.index')->with('success','Permission update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     * @param Permission $permission
     * @return
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->back()->with('success', 'Permission deleted successfully!');
    }
}

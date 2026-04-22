<?php

namespace App\Http\Controllers;

use App\Models\Administration;
use App\Models\User;
use Illuminate\Http\Request;

class AdministrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $administrations = Administration::all();
        return view('administrations.index',compact('administrations'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('administrations.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'sick'   => 'required|integer|min:0',
            'casual' => 'required|integer|min:0',
        ]);

        $existing = Administration::first();

        if ($existing) {
            return redirect()->back()->with('error', 'Already submitted. You cannot submit again.');
        }

        $administration = Administration::create([
            'sick' => $data['sick'],
            'casual' => $data['casual'],
        ]);

        return redirect()->back()->with('success','Administration store successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Administration $administration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param Administration $administration
     */
    public function edit($id)
    {
        $administration = Administration::findOrFail($id);
        return view('administrations.edit',compact('administration'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Administration $administration)
    {
        $data = $request->validate([
            'sick' => 'required|integer|min:0',
            'casual' => 'required|integer|min:0',
        ]);

        $administration->update($data);

        return redirect()->back()->with('success', 'Administration updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param Administration $administration
     */
    public function destroy(Administration $administration)
    {
        $administration->delete();
        return redirect()->back()->with('success','Administration is delete successfully!');
    }
}

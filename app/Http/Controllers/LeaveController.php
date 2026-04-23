<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('leaves.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'form_date' => 'required',
            'to_date'   => 'required',
            'leave_type' => 'required',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        $attachmentPath = null;

        if ($request->hasFile('attachment'))
        {
            $attachmentPath = $request->file('attachment')->store('Permissions','public');
        }

        Leave::create([
            'user_id' => Auth::id(),
            'form_date' => $request->form_date,
            'to_date' => $request->to_date,
            'leave_type' => $request->leave_type,
            'attachment' => $attachmentPath,
            'approved_by' => null,
            'approved_at' => null,
        ]);

        return redirect()->back()->with('success','Leave application submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Leave $leave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leave $leave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Leave $leave)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leave $leave)
    {
        //
    }
}

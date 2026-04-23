<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaves = Leave::all();
        return view('leave.index',compact('leaves'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('leave.create');
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
            $attachmentPath = $request->file('attachment')->store('images','public');
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
     * @param Leave $leave
     * @return \Illuminate\Container\Container|\Illuminate\Container\TClass|object
     */
    public function edit(Leave $leave)
    {
//        dd($leave);
        return view('leave.edit', compact('leave'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Leave $leave
     * @return
     */
    public function update(Request $request, Leave $leave)
    {
        $validated = $request->validate([
            'form_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:form_date',
            'leave_type' => 'required|string',
            'reason' => 'nullable|string',
        ]);


        $attachmentPath = $leave->attachment;


        if ($request->hasFile('attachment')) {

            if ($leave->attachment && Storage::exists($leave->attachment)) {
                Storage::delete($leave->attachment);
            }

            $attachmentPath = $request->file('attachment')->store('image');
        }

        // update data
        $leave->update([
            'form_date' => $request->form_date,
            'to_date' => $request->to_date,
            'leave_type' => $request->leave_type,
            'reason' => $request->reason,
            'attachment' => $attachmentPath,
        ]);

        return redirect()->route('leave.index')->with('success', 'Leave updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     * @param Leave $leave
     */
    public function destroy(Leave $leave)
    {
        $leave->delete();
        return redirect()->back()->with('success','Leave delete successfully!');
    }
}

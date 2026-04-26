<?php

namespace App\Http\Controllers;

use App\Models\Administration;
use App\Models\Leave;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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
     * @param Leave $leave
     * @return
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'form_date' => 'required|date',
            'to_date'   => 'required|date|after_or_equal:form_date',
            'leave_type' => 'required',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        $start = Carbon::parse($request->form_date);
        $end = Carbon::parse($request->to_date);

        $daysDifference = $start->diffInDays($end) + 1;

        $userId = Auth::id();

        $admin = Administration::first();

        // Sick count
        $sickCount = User::findOrFail($userId)
            ->leaves()
            ->where('leave_type', 'sick')
            ->whereIn('status', ['approved', 'pending'])
            ->get()
            ->sum(function ($leave) {
                return Carbon::parse($leave->form_date)
                        ->diffInDays(Carbon::parse($leave->to_date)) + 1;
            });

        // Casual count
        $casualCount = User::findOrFail($userId)
            ->leaves()
            ->where('leave_type', 'casual')
            ->whereIn('status', ['approved', 'pending'])
            ->get()
            ->sum(function ($leave) {
                return Carbon::parse($leave->form_date)
                        ->diffInDays(Carbon::parse($leave->to_date)) + 1;
            });

        $leaveType = $request->leave_type;

        if ($leaveType === 'sick' && ($sickCount + $daysDifference) > $admin->sick) {
            return back()->with('error', 'Sick leave limit exceeded!');
        }

        if ($leaveType === 'casual' && ($casualCount + $daysDifference) > $admin->casual) {
            return back()->with('error', 'Casual leave limit exceeded!');
        }

        $attachmentPath = null;

        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('images', 'public');
        }

        Leave::create([
            'user_id' => $userId,
            'form_date' => $request->form_date,
            'to_date' => $request->to_date,
            'leave_type' => $leaveType,
            'attachment' => $attachmentPath,
            'status' => 'pending',
            'approved_at' => null,
        ]);

        return back()->with('success', 'Leave application submitted successfully!');
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


    public function approve(Leave $leave)
    {
        $admin = Administration::first();

        $userId = $leave->user_id;


        $sickCount = User::findOrFail($userId)
            ->leaves()
            ->where('leave_type', 'sick')
            ->whereIn('status', ['approved', 'pending'])
            ->get()
            ->sum(function ($leave) {
                return Carbon::parse($leave->form_date)
                        ->diffInDays(Carbon::parse($leave->to_date)) + 1;
            });
//        dd($sickCount);

        $casualCount = User::findOrFail($userId)
            ->leaves()
            ->where('leave_type', 'casual')
            ->where('status', 'approved')
            ->get()
            ->sum(function ($leave) {
                return Carbon::parse($leave->form_date)
                        ->diffInDays(Carbon::parse($leave->to_date)) + 1;
            });
//        dd($casualCount);

        // Sick leave check
        if ($leave->leave_type === 'sick' && $sickCount >= $admin->sick) {
            $leave->update([
                'status' => 'rejected',
                'approved_at' => now(),
            ]);
            return back()->with('error', 'Sorry, you are not eligible to take more sick leave!');
        }

        // Casual leave check
        if ($leave->leave_type === 'casual' && $casualCount >= $admin->casual) {
            $leave->update([
                'status' => 'rejected',
                'approved_at' => now(),
            ]);
            return back()->with('error', 'Sorry, you are not eligible to take more casual leave!');
        }

        $leave->update([
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Approved!');
    }

    public function reject(Leave $leave)
    {
        $leave->update([
            'status' => 'rejected',
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Rejected successfully!');
    }
}

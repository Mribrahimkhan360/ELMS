<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Administration;
use App\Models\Leave;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiLeaveController extends Controller
{

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $validated = $request->validate([
            'form_date' => 'required|date',
            'to_date'   => 'required|date|after_or_equal:form_date',
            'leave_type' => 'required',
            'reason' => 'required|string',
        ]);

        $start = Carbon::parse($validated['form_date']);
        $end = Carbon::parse($validated['to_date']);
        $daysDifference = $start->diffInDays($end) + 1;

        $user = User::findOrFail(Auth::id());
        $admin = Administration::first();

        if (!$admin) {
            return response()->json([
                'status' => false,
                'message' => 'Admin configuration not found!'
            ], 500);
        }

        $sickCount = $user->leaves()
            ->where('leave_type', 'sick')
            ->whereIn('status', ['approved', 'pending'])
            ->get()
            ->sum(fn($leave) =>
                Carbon::parse($leave->form_date)
                    ->diffInDays(Carbon::parse($leave->to_date)) + 1
            );

        $casualCount = $user->leaves()
            ->where('leave_type', 'casual')
            ->whereIn('status', ['approved', 'pending'])
            ->get()
            ->sum(fn($leave) =>
                Carbon::parse($leave->form_date)
                    ->diffInDays(Carbon::parse($leave->to_date)) + 1
            );

        if ($validated['leave_type'] === 'sick' && ($sickCount + $daysDifference) > $admin->sick) {
            return response()->json([
                'status' => false,
                'message' => 'Sick leave limit exceeded!'
            ], 422);
        }

        if ($validated['leave_type'] === 'casual' && ($casualCount + $daysDifference) > $admin->casual) {
            return response()->json([
                'status' => false,
                'message' => 'Casual leave limit exceeded!'
            ], 422);
        }

        $attachmentPath = null;

        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('leave-attachments', 'public');
        }

        Leave::create([
            'user_id' => $user->id,
            'form_date' => $validated['form_date'],
            'to_date' => $validated['to_date'],
            'leave_type' => $validated['leave_type'],
            'reason' => $validated['reason'],
            'attachment' => $attachmentPath,
            'status' => 'pending',
            'approved_at' => null,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Leave applied successfully!',
        ], 201);
    }

    public function profile(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'status'    => true,
            'message'   => 'User profile fetched successfully!',
            'data'      => $user
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }

}

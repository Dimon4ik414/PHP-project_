<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleRequestController extends Controller
{

    public function create()
    {
        $user = Auth::user();
        $availableRoles = RoleRequest::getAvailableRoles($user->role);
        $hasPendingRequest = RoleRequest::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->exists();

        return view('role-request.create', compact('user', 'availableRoles', 'hasPendingRequest'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'requested_role' => 'required|string',
            'reason' => 'nullable|string|max:1000',
        ]);

        RoleRequest::create([
            'user_id' => Auth::id(),
            'current_role' => Auth::user()->role,
            'requested_role' => $validated['requested_role'],
            'reason' => $validated['reason'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('role-request.my-requests')
            ->with('success', 'Запрос отправлен на рассмотрение');
    }

    public function myRequests()
    {
        $requests = RoleRequest::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('role-request.my-requests', compact('requests'));
    }
}

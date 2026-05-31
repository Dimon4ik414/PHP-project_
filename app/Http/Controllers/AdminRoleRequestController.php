<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RoleRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminRoleRequestController extends Controller
{
    public function index()
    {
        $requests = RoleRequest::with(['user', 'processedBy'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.index', compact('requests'));
    }

    public function show(RoleRequest $roleRequest)
    {
        $roleRequest->load(['user', 'processedBy', 'comments.user']);
        return view('admin.show', compact('roleRequest'));
    }

    public function process(Request $request, RoleRequest $roleRequest)
    {
        $validated = $request->validate([
            'action' => 'required|in:approved,rejected',
            'admin_comment' => 'nullable|string|max:500',
        ]);

        if ($roleRequest->status !== 'pending') {
            return back()->with('error', 'Этот запрос уже обработан.');
        }

        $roleRequest->status = $validated['action'];
        $roleRequest->processed_by = Auth::id();
        $roleRequest->admin_comment = $validated['admin_comment'] ?? null;
        $roleRequest->processed_at = now();

        if ($validated['action'] === 'approved') {
            $user = User::find($roleRequest->user_id);
            $user->role = $roleRequest->requested_role;
            $user->save();
        }

        $roleRequest->save();

        $message = $validated['action'] === 'approved'
            ? 'Запрос одобрен. Роль пользователя повышена.'
            : 'Запрос отклонен.';

        return redirect()->route('admin.role-requests.index')
            ->with('success', $message);
    }

    public function addComment(Request $request, RoleRequest $roleRequest)
    {
        $validated = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        \App\Models\Comment::create([
            'role_request_id' => $roleRequest->id,
            'user_id' => Auth::id(),
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'comment' => $validated['body'],
            'approved' => true,
        ]);

        return back()->with('success', 'Комментарий добавлен');
    }

    public function userProfile(User $user)
    {
        $user->load(['roleRequests' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }, 'roleRequests.comments', 'roleRequests.processedBy']);

        return view('admin.user', compact('user'));
    }
}

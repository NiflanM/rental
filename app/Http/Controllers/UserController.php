<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // ONLY ADMIN
        if(auth()->user()->role !== 'admin'){
            abort(403);
        }

        $users = User::latest()->get();

        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        if(auth()->user()->role !== 'admin'){
            abort(403);
        }

        $request->validate([
            'role' => 'required|in:admin,user'
        ]);

        $user->update([
            'role' => $request->role
        ]);

        return back()->with('success', 'User role updated successfully.');
    }

    public function destroy(User $user)
    {
        if(auth()->user()->role !== 'admin'){
            abort(403);
        }

        // PREVENT SELF DELETE
        if($user->id === auth()->id()){
            return back()->with('error', 'You cannot delete yourself.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }
}
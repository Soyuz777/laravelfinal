<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserAdminController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->get(); // exclude self/admin
        return view('admin.users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Cannot delete admin users.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function view() {
        $users = User::where('user_type', 'user')->get();
        return view('admin.users.view_users', compact('users'));
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        return view('admin.users.edit_user', compact('user'));
    }

    public function update(Request $request, $id) {
        // Validation
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email',
            'user_type' => 'required|in:user,admin',
            'password'  => 'nullable|string|min:6|confirmed',
        ]);

        $user = User::findOrFail($id);

        // Update basic fields
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_type = $request->user_type;

        // Update password only if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users')->with('message', 'User updated successfully!');
    }

    public function delete($id) {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.users')->with('message', 'User deleted successfully!');
    }
}

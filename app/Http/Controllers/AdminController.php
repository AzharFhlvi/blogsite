<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('admin.index', compact('users'));
    }

    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->delete();

        flash()->addSuccess('User deleted successfully!');

        return redirect(route('admin.index'));
    }

    public function resetPassword(User $user)
    {
        $user->password = bcrypt('password');
        $user->save();

        flash()->addSuccess('Password reset successfully!');

        return redirect(route('admin.index'));
    }
}

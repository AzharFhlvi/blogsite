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
        $user->delete();

        return redirect(route('admin.index'));
    }

    public function resetPassword(User $user)
    {
        $user->password = bcrypt('password');
        $user->save();

        return redirect(route('admin.index'));
    }
}

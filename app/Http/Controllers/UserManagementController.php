<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::select('id', 'name', 'email', 'created_at')->get();

        return view('user_management', compact('users'));
    }

    public function create()
    {
        return view('create_user');
    }
}

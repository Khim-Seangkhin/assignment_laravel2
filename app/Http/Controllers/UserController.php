<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create_user');
    }

    public function store(Request $req)
    {
        $req->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            'password_confirmation' => ['required',],
        ]);

        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->department = $req->department;
        $user->role = $req->role;
        $user->password = Hash::make($req->password);
        $user->save();

        $msg = [
            'message' => 'New record created successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('user.index')->with($msg);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit_user', compact('user'));
    }

    public function update(Request $req, $id)
    {
        $user = User::find($id);
        $user->department = $req->department;
        $user->role = $req->role;
        $user->save();

        $msg = [
            'message' => 'User updated successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('user.index')->with($msg);
    }

    public function  logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function mission_approve(Request $req)
    {
        $table_th = strval($req->table_th);
        $user = User::find($req->id);
        $user->$table_th = 'mission_approved';
        $user->save();
        return response()->json(['success' => 'Mission has been approved.']);
    }

    public function mission_reject(Request $req)
    {
        $table_th = strval($req->table_th);
        $user = User::find($req->id);
        $user->$table_th = 'mission_rejected';
        $user->save();
        return response()->json(['success' => 'Mission has been rejected.']);
    }

    public function leave_approve(Request $req)
    {
        $table_th = strval($req->table_th);
        $user = User::find($req->id);
        $user->$table_th = 'leave_approved';
        $user->save();
        return response()->json(['success' => 'Leave has been approved.']);
    }

    public function leave_reject(Request $req)
    {
        $table_th = strval($req->table_th);
        $user = User::find($req->id);
        $user->$table_th = 'leave_rejected';
        $user->save();
        return response()->json(['success' => 'Leave has been rejected.']);
    }
}

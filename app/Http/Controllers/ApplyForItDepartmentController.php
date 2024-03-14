<?php

namespace App\Http\Controllers;

use App\Models\ApplyMissionLeave;
use App\Models\User;
use Illuminate\Http\Request;

class ApplyForItDepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $apply_mission_leaves = ApplyMissionLeave::where('department','it')->get();
        return view('apply_for_it_department.index', compact('apply_mission_leaves'));
    }

    public function create()
    {
        $users = User::where('department','it')->get();
        return view('apply_for_it_department.create', compact('users'));
    }

    public function store(Request $req)
    {
        $ml = new ApplyMissionLeave;
        $ml->user_id = $req->user_id;
        $ml->department = $req->department;
        $ml->mission_leave_request = $req->mission_leave_request;
        $ml->approver = $req->approver;
        $ml->save();

        $msg = [
            'message' => 'New record created successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('apply_for_it_department.index')->with($msg);
    }

    public function edit($id)
    {
        $users = User::all();
        $ml_request = ApplyMissionLeave::find($id);
        return view('apply_for_it_department.edit', compact('users', 'ml_request'));
    }

    public function update(Request $req, $id)
    {
        $ml = ApplyMissionLeave::find($id);
        $ml->user_id = $req->user_id;
        $ml->mission_leave_request = $req->mission_leave_request;
        $ml->approver = $req->approver;
        $ml->submit_mission_leave = null;
        $ml->approve_reject = null;
        $ml->save();

        $msg = [
            'message' => 'Your record updated successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('apply_for_it_department.index')->with($msg);
    }


}

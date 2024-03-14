<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApplyMissionLeave;

class MissionLeaveSubmitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $apply_mission_leaves = ApplyMissionLeave::all();
        return view('mission_leave_submit.index', compact('apply_mission_leaves'));
    }

    public function submitMission($id)
    {
        ApplyMissionLeave::find($id)->update(['submit_mission_leave'=>'mission_submited']);
        $msg = [
            'message' => 'Mission submited!',
            'alert-type' => 'success'
        ];
        return redirect()->route('mission_leave_submit.index')->with($msg);
    }

    public function submitLeave($id)
    {
        ApplyMissionLeave::find($id)->update(['submit_mission_leave'=>'leave_submited']);
        $msg = [
            'message' => 'Leave submited!',
            'alert-type' => 'success'
        ];
        return redirect()->route('mission_leave_submit.index')->with($msg);
    }
}

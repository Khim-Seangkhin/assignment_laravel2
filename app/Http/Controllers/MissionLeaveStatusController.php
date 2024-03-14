<?php

namespace App\Http\Controllers;

use App\Models\ApplyMissionLeave;
use Illuminate\Http\Request;

class MissionLeaveStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $apply_mission_leaves = ApplyMissionLeave::where('approve_reject','!=',null)->get();
        return view('mission_leave_status.index', compact('apply_mission_leaves'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ApplyMissionLeave;
use Illuminate\Http\Request;

class SaleDepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $apply_mission_leaves = ApplyMissionLeave::where('submit_mission_leave','!=',null)
                                ->where('department','sale')->get();
        return view('sale_departments.index', compact('apply_mission_leaves'));
    }

    public function approve($id)
    {
        ApplyMissionLeave::find($id)->update(['approve_reject'=>'approved']);
        $msg = [
            'message' => 'Request has been approved!',
            'alert-type' => 'success'
        ];
        return redirect()->route('sale_department.index')->with($msg);
    }

    public function reject($id)
    {
        ApplyMissionLeave::find($id)->update(['approve_reject'=>'rejected']);
        $msg = [
            'message' => 'Request has been rejected!',
            'alert-type' => 'success'
        ];
        return redirect()->route('sale_department.index')->with($msg);
    }
}

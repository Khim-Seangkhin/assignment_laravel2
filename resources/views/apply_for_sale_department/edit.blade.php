@extends('layouts.app')

@section('content')
    <div class="container mb-5">
        <h4>Create Mission/Leave</h4>
        <hr>
        <p><a href="{{ route('apply_for_sale_department.index') }}" class="btn btn-dark btn-sm">Back</a></p>
        <form action="{{ route('apply_for_sale_department.update',$ml_request->id) }}" method="POST">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7">
                            @csrf
                            <div class="mb-3 row">
                                <label for="" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <select name="user_id" id="" class="form-control">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ $user->id == $ml_request->user_id?'selected':'' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="" class="col-sm-2 col-form-label">Request</label>
                                <div class="col-sm-10">
                                    <select name="mission_leave_request" id="" class="form-control" required>
                                        <option value="mission">Mission</option>
                                        <option value="leave">Leave</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="" class="col-sm-2 col-form-label">Approver</label>
                                <div class="col-sm-10">
                                    <select name="approver" id="" class="form-control" required>
                                        <option value="team_leader">Team Leader</option>
                                        <option value="hr">HR Manager</option>
                                        <option value="ceo">CEO</option>
                                        <option value="cfo">CFO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-dark btn-sm">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
@endsection

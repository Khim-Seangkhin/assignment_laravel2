@extends('layouts.app')

@section('content')
    <div class="container mb-5">
        <h4>Apply for IT Department List</h4>
        <hr>
        <p><a href="{{ route('apply_for_it_department.create') }}" class="btn btn-dark btn-sm">Add</a></p>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Request</th>
                        <th>Approver</th>
                        <th>Action</th>
                    </tr>
                        </thead>
                        <tbody>
                            @foreach ($apply_mission_leaves as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->mission_leave_request }}</td>
                                    <td>{{ $item->approver }}</td>
                                    <td>
                                        <a href="{{ route('apply_for_it_department.edit',$item->id) }}" class="btn btn-dark" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

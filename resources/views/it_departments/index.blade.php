@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
                <h4>It Department List</h4>
                <hr>

                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Request</th>
                                    <th>Approver</th>
                                    <th>Approve/Reject</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- declear variable -->
                                @php
                                $role = Auth::user()->role;
                            @endphp
                                @foreach ($apply_mission_leaves as $item)
                                    @if ($item->approve_reject != null)
                                        
                                    @else
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->submit_mission_leave == 'mission_submited' ? 'mission requested' : 'leave requested' }}
                                        </td>
                                        <td>{{ $item->approver }}</td>
                                        <td>
                                            <a href="{{ route('it_department.approve', 
                                            $item->id) }}" class="btn btn-primary {{ $item->approver == $role ? '' : 'disabled' }}"
                                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Approve</a>

                                            <a href="{{ route('it_department.reject', $item->id) }}" class="btn btn-danger {{ $item->approver == $role ? '' : 'disabled' }}"
                                                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Reject</a>
                                        </td>
                                    </tr>
                                        
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

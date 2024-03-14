@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
                <h4>Mision/Leave Status List</h4>
                <hr>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Request</th>
                                <th>Approver</th>
                                <th>Approved/Rejected</th>
                            </thead>
                            <tbody> 
                                @foreach ($apply_mission_leaves as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->mission_leave_request }}</td>
                                        <td>{{ $item->approver }}</td>
                                        <td>
                                            @if ($item->approve_reject == 'approved')
                                                <span class="badge text-bg-primary">{{ $item->approve_reject }}</span>
                                            @else
                                                <span class="badge text-bg-danger">{{ $item->approve_reject }}</span>
                                            @endif
                                            
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function req_or_rem_mission(_this, id) {
            var title = $(_this).data('name');
            var status = $(_this).prop('checked') == true ? 1 : 0;
            $.ajax({
                type: "get",
                url: "{{ url('/attendace_sheet/mission_request') }}",
                data: {
                    id: id,
                    title: title,
                    status: status,
                },
                dataType: "json",
                success: function(data) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success,
                        })
                    }
                }
            });
        }

        function req_or_rem_leave(_this, id) {
            var title = $(_this).data('name');
            var status = $(_this).prop('checked') == true ? 0 : 1;
            $.ajax({
                type: "get",
                url: "{{ url('/attendace_sheet/leave_request') }}",
                data: {
                    id: id,
                    title: title,
                    status: status,
                },
                dataType: "json",
                success: function(data) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success,
                        })
                    }
                }
            });
        }
    </script>
@endsection

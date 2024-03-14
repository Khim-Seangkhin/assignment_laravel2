@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
                <h4>Submit Mission/Leave List</h4>
                <hr>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Request</th>
                                <th>Approver</th>
                                <th>Submit Mission/Leave</th>
                            </thead>
                            <tbody> 
                                @php
                                    $id = Auth::user()->id;
                                @endphp
                                @foreach ($apply_mission_leaves as $item)
                                    @if ($item->submit_mission_leave != null)

                                    @else
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->mission_leave_request }}</td>
                                            <td>{{ $item->approver }}</td>
                                            <td>
                                                @if ($item->mission_leave_request == 'mission')
                                                    <a 
                                                        href="{{ route('mission_leave_submit.submit_mission',$item->id) }}" 
                                                        class="btn btn-primary {{ $item->user_id === $id ? '' : 'disabled' }}" 
                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                    >Submit</a>
                                                    
                                                @else
                                                    
                                                    <a 
                                                        href="{{ route('mission_leave_submit.submit_leave',$item->id) }}"
                                                        class="btn btn-danger {{ $item->user_id === $id ? '' : 'disabled' }}"
                                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                    >Submit</a>
                                                @endif
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

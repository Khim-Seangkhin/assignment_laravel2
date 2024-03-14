<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Assignment</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.bootstrap5.min.css">
    <style>
        .bg-custom {
            background-color: red !important;
            border-color: red !important;
        }
    </style>
</head>

<body style="background-color: #ccc">
    <div id="app">

        <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
            <div class="container">
                {{-- <a class="navbar-brand" href="{{ url('/home') }}">
                    Logo.
                </a> --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a 
                                class="nav-link 
                                {{ 
                                    request()->routeIs('user.index') || 
                                    request()->routeIs('user.create') || 
                                    request()->routeIs('user.edit') ? 'active' : '' 
                                }}" 
                                aria-current="page" 
                                href="{{ route('user.index') }}"
                            >User</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Apply Mission/Leave
                            </a>
                            <ul class="dropdown-menu">
                              <li>
                                    <a 
                                        class="dropdown-item 
                                        {{ 
                                            Auth::user()->department == 'it' && 
                                            Auth::user()->role == 'department_admin' ? '' : 'disabled'
                                        }}
                                        {{ 
                                            request()->routeIs('apply_for_it_department.index') ||
                                            request()->routeIs('apply_for_it_department.create') ||
                                            request()->routeIs('apply_for_it_department.edit') ? 'active' : ''
                                        }}" 
                                        href="{{ route('apply_for_it_department.index') }}"
                                    >For IT Department</a>
                                </li>
                              <li>
                                    <a 
                                        class="dropdown-item 
                                        {{ 
                                            Auth::user()->department == 'sale' && 
                                            Auth::user()->role == 'department_admin' ? '' : 'disabled'
                                        }}
                                        {{ 
                                            request()->routeIs('apply_for_sale_department.index') ||
                                            request()->routeIs('apply_for_sale_department.create') ||
                                            request()->routeIs('apply_for_sale_department.edit') ? 'active' : ''
                                        }}" 
                                        href="{{ route('apply_for_sale_department.index') }}"
                                    >For Sale Department</a>
                                </li>
                              
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a 
                                class="nav-link {{ request()->routeIs('mission_leave_submit.index') ? 'active' : '' }}"
                                href="{{ route('mission_leave_submit.index') }}"
                            >Submit Misssion/Leave</a>
                        </li>
                        <li class="nav-item">
                            <a 
                                class="nav-link {{ request()->routeIs('mission_leave_status.index') ? 'active' : '' }}"
                                href="{{ route('mission_leave_status.index') }}"
                            >Misssion/Leave Status</a>
                        </li>
                        <li class="nav-item">
                            <a 
                                class="nav-link 
                                {{ request()->routeIs('it_department.index') ? 'active' : '' }}" 
                                href="{{ route('it_department.index') }}">IT Department</a>
                        </li>
                        <li class="nav-item">
                            <a 
                                class="nav-link {{ request()->routeIs('sale_department.index') ? 'active' : '' }}" 
                                href="{{ route('sale_department.index') }}">Sale Department</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name ?? 'Profile' }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('user.logout') }}">
                                    {{ __('Logout') }}
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <!-- Modal Mission Requested -->
        <div class="modal fade" id="mission_request" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">
                            Modal Title
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <div>
                            <input type="hidden" class="user-id">
                            <input type="hidden" class="username">
                            <input type="hidden" class="table-th">
                        </div>
                        <button type="button" class="btn btn-primary btn-sm"
                            onclick="mission_approve()">Approve</button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="mission_reject()">Reject</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Leave Request -->
        <div class="modal fade" id="leave_requested" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">
                            Modal Title
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <div>
                            <input type="hidden" class="user-id">
                            <input type="hidden" class="username">
                            <input type="hidden" class="table-th">
                        </div>
                        <button type="button" class="btn btn-primary btn-sm"
                            onclick="leave_approve()">Approve</button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="leave_reject()">Reject</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- scripts js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        new DataTable('#example');
    </script>
    @if (Session::has('message'))
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        </script>
    @endif
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

        $('body').on('click', 'table tr td .mission-approve-reject', function() {
            var Parent = $(this).parents('tr');
            var user_id = Parent.find('td:eq(0)').text();
            var username = Parent.find('td:eq(1)').text();
            var table_th = $(this).prop('name');
            $('.modal-title').text(`${user_id}. ${username}`);
            $('.user-id').val(user_id);
            $('.username').val(username);
            $('.table-th').val(table_th);
            $(this).addClass('clicked');
        })

        function mission_approve() {
            var id = $('.user-id').val();
            var table_th = $('.table-th').val();
            $.ajax({
                type: "get",
                url: "{{ url('/user/mission_approve') }}",
                data: {
                    id: id,
                    table_th: table_th
                },
                dataType: "json",
                success: function(data) {
                    $('.modal').modal('hide').parents('td').text('!--');
                    $('.clicked').hide();
                    $('.clicked').parents('td').text('!--');
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

        function mission_reject() {
            var id = $('.user-id').val();
            var table_th = $('.table-th').val();
            $.ajax({
                type: "get",
                url: "{{ url('/user/mission_reject') }}",
                data: {
                    id: id,
                    table_th: table_th
                },
                dataType: "json",
                success: function(data) {
                    $('.modal').modal('hide');
                    $('.clicked').hide();
                    $('.clicked').parents('td').text('!--');
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

        $('body').on('click', 'table tr td .leave-approve-reject', function() {
            var Parent = $(this).parents('tr');
            var user_id = Parent.find('td:eq(0)').text();
            var username = Parent.find('td:eq(1)').text();
            var table_th = $(this).prop('name');
            $('.modal-title').text(`${user_id}. ${username}`);
            $('.user-id').val(user_id);
            $('.username').val(username);
            $('.table-th').val(table_th);
            $(this).addClass('clicked');
        })

        function leave_approve() {

            var id = $('.user-id').val();
            var table_th = $('.table-th').val();
            $.ajax({
                type: "get",
                url: "{{ url('/user/leave_approve') }}",
                data: {
                    id: id,
                    table_th: table_th
                },
                dataType: "json",
                success: function(data) {
                    $('.modal').modal('hide');
                    $('.clicked').hide();
                    $('.clicked').parents('td').text('!--');
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

        function leave_reject() {

            var id = $('.user-id').val();
            var table_th = $('.table-th').val();
            $.ajax({
                type: "get",
                url: "{{ url('/user/leave_reject') }}",
                data: {
                    id: id,
                    table_th: table_th
                },
                dataType: "json",
                success: function(data) {
                    $('.modal').modal('hide');
                    $('.clicked').hide();
                    $('.clicked').parents('td').text('!--');
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
</body>

</html>

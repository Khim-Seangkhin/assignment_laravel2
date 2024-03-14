@extends('layouts.app')

@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-md">
                <h4>User List</h4>
                <hr>
                <p>
                    <a 
                        href="{{ route('user.create') }}" 
                        class="btn btn-dark btn-sm {{ Auth::user()->role === 'admin' ? '' : 'disabled' }}" 
                    >Add</a>
                </p>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Position</th>
                                    <th>Department</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->position }}</td>
                                        <td>{{ $user->department }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>
                                            <a 
                                                href="{{ route('user.edit',$user->id) }}" 
                                                class="btn btn-dark btn-sm {{ Auth::user()->role === 'admin' ? '' : 'disabled' }}"
                                            >Edit</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No data!</td>
                                    </tr>
                                @endforelse
                                
                            </tbody>
                        </table>
                        {{-- {{ $users->links('pagination::bootstrap-5') }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-md">
                <h4>Edit User</h4>
                <hr>
                <p><a href="{{ route('user.index') }}" class="btn btn-dark btn-sm">Back</a></p>
                <form action="{{ route('user.update',$user->id) }}" method="POST">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-7">
                                    @csrf
                                    <div class="mb-3 row">
                                        <label for="" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" disabled>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" disabled>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="" class="col-sm-2 col-form-label">Department</label>
                                        <div class="col-sm-10">
                                            <select name="department" id="" class="form-control">
                                                <option value="it">IT</option>
                                                <option value="sale">Sale</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="" class="col-sm-2 col-form-label">Role</label>
                                        <div class="col-sm-10">
                                            <select name="role" id="" class="form-control">
                                                <option value="user">User</option>
                                                <option value="system_admin">System Admin</option>
                                                <option value="department_admin">Department Admin</option>
                                                <option value="ceo">CEO</option>
                                                <option value="ceo">CFO</option>
                                                <option value="team leader">Team Leader</option>
                                                <option value="hr">HR</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="" class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="password" id="" class="form-control" disabled>
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="" class="col-sm-2 col-form-label">Confirm Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="password_confirmation" id="" class="form-control" disabled>
                                            @error('password_confirmation')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
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
            </div>
        </div>
    </div>
@endsection

@extends('admin.layouts.app')
@section('content')
<div class="card shadow mb-4 mt-5">
    <div class="card-body">
        <h3 class="font-weight-bold text-secondary mb-2 mt-2"><strong>Tambah User</strong></h3>
        <form class="p-3" method="POST" action="{{route('user-store')}}">
            @csrf
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="col-md-6">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="nip">NIP</label>
                    <input type="text" class="form-control" id="nip" name="nip" required>
                </div>
                <div class="col-md-6">
                    <label for="jabatan">Jabatan</label>
                    <input type="text" class="form-control" id="jabatan" name="jabatan" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="role_id">Role</label>
                    <select class="form-control" id="role_id" name="role_id" required>
                        @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" id="password" name="password" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>
            <button type="submit" class="btn btn-secondary mt-3">Submit</button>
        </form>

    </div>
</div>
@endsection
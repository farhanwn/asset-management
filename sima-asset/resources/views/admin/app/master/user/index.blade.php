@extends('admin.layouts.app')

@section('content')
<div class="card mb-4 mt-5">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-2 mt-2">
            <h3 class="text-secondary"><strong>Data User</strong></h3>
            <a href="{{route('user-create')}}" type="button" class="btn btn-success mb-4">
                Tambah User +
            </a>
        </div>
        <div class="table-responsive">
            <table id="userTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>NIP</th>
                        <th>Jabatan</th>
                        <th>Role</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->nip}}</td>
                        <td>{{$user->jabatan}}</td>
                        @if($user->role_id == 1)
                        <td><span class="badge badge-primary">{{$user->role->name}}</span></td>
                        @elseif($user->role_id == 2)
                        <td><span class="badge badge-success">{{$user->role->name}}</span></td>
                        @elseif($user->role_id == 3)
                        <td><span class="badge badge-warning">{{$user->role->name}}</span></td>
                        @endif
                        <td class="text-center">
                            <form action="{{route('user-delete', $user->id)}}" method="POST">
                                <a href="{{route('user-edit', $user->id)}}" type="button" class="btn btn-warning text-light text-right mb-4">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger text-right mb-4">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
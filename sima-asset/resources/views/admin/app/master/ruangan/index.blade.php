@extends('admin.layouts.app')

@section('content')
<div class="card mb-4 mt-5">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-2 mt-2">
            <h3 class="text-secondary"><strong>Data Ruangan</strong></h3>
            <a href="{{route('ruangan-create')}}" type="button" class="btn btn-success mb-4">
                Tambah Ruangan +
            </a>
        </div>
        <div class="table-responsive">
            <table id="userTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Kode Ruangan</th>
                        <th class="text-center">Penganggung Jawab</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($ruangans as $key => $data)
                    <tr>
                        <td class="text-center">{{$key+=1}}</td>
                        <td class="text-center">{{$data->nama}}</td>
                        <td class="text-center">{{$data->kode_ruangan}}</td>
                        <td class="text-center">{{$data->user->name}}</td>
                        <td class="text-center">
                            <form action="{{route('ruangan-delete', $data->id)}}" method="POST">
                                <a href="{{route('ruangan-edit', $data->id)}}" type="button" class="btn btn-warning text-light text-right mb-4">
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
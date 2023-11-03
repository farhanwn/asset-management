@extends('admin.layouts.app')

@section('content')
<div class="card mb-4 mt-5">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-2 mt-2">
            <h3 class="text-secondary"><strong>Data Inventaris</strong></h3>
            <a href="{{route('inventaris-create')}}" type="button" class="btn btn-success mb-4">
                Tambah Inventaris +
            </a>
        </div>
        <div class="table-responsive">
            <table id="userTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Kode Inventaris</th>
                        <th class="text-center">Aset</th>
                        <th class="text-center">Ruangan</th>
                        <th class="text-center">Kondisi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($datas as $key => $data)
                    <tr>
                        <td class="text-center">{{$key+=1}}</td>
                        <td class="text-center">{{$data->kode_inventaris}}</td>
                        <td class="text-center">{{$data->aset->nama}}</td>
                        <td class="text-center">{{$data->ruangan->nama}}</td>
                        @if($data->kondisi == 0)
                        <td class="text-center"><span class="badge badge-success">Baik</span></td>
                        @elseif($data->kondisi == 1)
                        <td class="text-center"><span class="badge badge-warning">Rusak Ringan</span></td>
                        @elseif($data->kondisi == 2)
                        <td class="text-center"><span class="badge badge-danger">Rusak Berat</span></td>
                        @endif
                        <td class="text-center">
                            <form action="{{route('inventaris-delete', $data->id)}}" method="POST">
                                <a href="{{route('inventaris-edit', $data->id)}}" type="button" class="btn btn-warning text-light text-right mb-4">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="{{route('inventaris-detail', $data->id)}}" type="button" class="btn btn-info text-right mb-4">
                                    <i class="fa-solid fa-info"></i>
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
@extends('admin.layouts.app')

@section('content')
<div class="card mb-4 mt-5">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-2 mt-2">
            <h3 class="text-secondary"><strong>Pelaporan Aset Rusak</strong></h3>
            <a href="{{route('pelaporan-create')}}" type="button" class="btn btn-success mb-4" {{Auth::user()->role_id !=3 ? 'hidden' : ''}}>
                Tambah Pelaporan +
            </a>
        </div>
        <div class="table-responsive">
            <table id="userTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">Kode</th>
                        <th class="text-center">Aset</th>
                        <th class="text-center">Ruangan</th>
                        <th class="text-center">Teknisi</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datas as $data)
                    <tr>
                        <td class="text-center">{{$data->kode_pelaporan}}</td>
                        <td class="text-center">{{$data->aset->nama}}</td>
                        <td class="text-center">{{$data->ruangan->nama}}</td>
                        <td class="text-center">{{$data->user->name}}</td>
                        @if($data->status == 0)
                        <td class="text-center"><span class="badge badge-secondary">Menunggu</span></td>
                        @elseif($data->status == 1)
                        <td class="text-center"><span class="badge badge-primary">Dalam Proses</span></td>
                        @elseif($data->status == 2)
                        <td class="text-center"><span class="badge badge-warning">Menunggu Aprroval Admin</span></td>
                        @elseif($data->status == 3)
                        <td class="text-center"><span class="badge badge-success">Selesai</span></td>
                        @endif
                        <td class="text-center">
                            <form action="{{route('pelaporan-delete', $data->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                @if($data->status == 0)
                                <a href="{{route('perbaikan-approved', $data->id)}}" type="button" class="btn btn-primary text-right mb-4" {{Auth::user()->role_id != 1 ? 'hidden':''}}>
                                    <i class="fa-solid fa-thumbs-up"></i>
                                </a>
                                @endif
                                <a href="{{route('pelaporan-detail', $data->id)}}" type="button" class="btn btn-info text-right mb-4">
                                    <i class="fa-solid fa-info"></i>
                                </a>
                                <button type="submit" class="btn btn-danger text-right mb-4" {{$data->status != 0 ? 'hidden': ''}}>
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
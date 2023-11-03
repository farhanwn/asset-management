@extends('admin.layouts.app')

@section('content')
<div class="card mb-4 mt-5">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-2 mt-2">
            <h3 class="text-secondary"><strong>Data Aset Rusak</strong></h3>
        </div>
        <div class="table-responsive">
            <table id="userTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
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
                            <a href="{{route('perbaikan-detail', $data->id)}}" type="button" class="btn btn-info text-right mb-4">
                                <i class="fa-solid fa-info"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
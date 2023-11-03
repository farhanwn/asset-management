@extends('admin.layouts.app')

@section('content')
<div class="card mb-4 mt-5">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-2 mt-2">
            <h3 class="font-weight-bold text-secondary"><strong>Data Aset</strong></h3>
            <a href="{{route('aset-create')}}" type="button" class="btn btn-success mb-4">
                Tambah Aset +
            </a>
        </div>
        <div class="table-responsive">
            <table id="userTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th rowspan="2" style="vertical-align: middle;" class="text-center">No</th>
                        <th rowspan="2" style="vertical-align: middle;">Nama</th>
                        <th rowspan="2" style="vertical-align: middle;" class="text-center">Tahun</th>
                        <th rowspan="2" style="vertical-align: middle;" class="text-center">Satuan</th>
                        <th rowspan="2" style="vertical-align: middle;" class="text-center">Jumlah</th>
                        <th colspan="2" class="text-center">Harga</th>
                        <th rowspan="2" style="vertical-align: middle;" class="text-center">Status</th>
                        <th rowspan="2" style="vertical-align: middle;" class="text-center">Aksi</th>
                    </tr>
                    <tr>
                        <th class="text-center">Persatuan</th>
                        <th class="text-center">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datas as $key => $data)
                    <tr>
                        <td class="text-center">{{$key+=1}}</td>
                        <td>{{$data->nama}}</td>
                        <td class="text-center">{{$data->tahun != null ? $data->tahun : '--'}}</td>
                        <td class="text-center">{{$data->satuan}}</td>
                        <td class="text-center">{{$data->jumlah ? $data->jumlah : '--'}}</td>
                        <td class="text-right">Rp. {{number_format($data->harga_satuan, 2)}}</td>
                        <td class="text-right">Rp. {{$data->harga_total ? number_format($data->harga_total, 2) : '0'}}</td>
                        @if($data->kondisi == 0)
                        <td class="text-center"><span class="badge badge-success">Baik</span></td>
                        @elseif($data->kondisi == 1)
                        <td class="text-center"><span class="badge badge-warning">Rusak Ringan</span></td>
                        @elseif($data->kondisi == 2)
                        <td class="text-center"><span class="badge badge-danger">Rusak Berat</span></td>
                        @endif
                        <td class="text-center">
                            <form action="{{route('aset-delete', $data->id)}}" method="POST">
                                <a href="{{route('aset-edit', $data->id)}}" type="button" class="btn btn-warning text-right text-light mb-4">
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
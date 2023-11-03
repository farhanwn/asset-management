@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-xl-6">
        <div class="card mb-4 mt-4">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3 mt-2">
                    <h2 class="font-weight-bold text-secondary"><strong>Detail Pelaporan</strong></h2>
                </div>
                <hr>
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th scope="row">Kode Pelaporan</th>
                            <td>{{$pelaporan->kode_pelaporan}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Aset</th>
                            <td>{{$pelaporan->aset->nama}} - {{$pelaporan->aset->kode_barang}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Ruangan</th>
                            <td>{{$pelaporan->ruangan->nama}} - {{$pelaporan->ruangan->kode_ruangan}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Teknisi</th>
                            <td>{{$pelaporan->user->name}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Catatan</th>
                            <td>{!!$pelaporan->catatan!!}</td>
                        </tr>
                        <tr>
                            <th scope="row">Status</th>
                            @if($pelaporan->status == 0)
                            <td><span class="badge badge-secondary">Menunggu</span></td>
                            @elseif($pelaporan->status == 1)
                            <td><span class="badge badge-primary">Dalam Proses</span></td>
                            @elseif($pelaporan->status == 2)
                            <td><span class="badge badge-warning">Menunggu Aprroval Admin</span></td>
                            @elseif($pelaporan->status == 3)
                            <td><span class="badge badge-success">Selesai</span></td>
                            @endif
                        </tr>
                        <tr>
                            <th scope="row">Foto</th>
                            <td>
                                <img src="{{asset('storage/uploads/'.$pelaporan->foto.'')}}" width="400" height="400" class="img-thumbnail" alt="foto-pelaporan">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @if($pelaporan->status == 1 && Auth::user()->role_id == 2)
    <div class="col-xl-6">
        <div class="card mb-4 mt-4">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3 mt-2">
                    <h2 class="font-weight-bold text-secondary"><strong>Perbaikan </strong></h2>
                </div>
                <hr>
                <form class="p-3" method="POST" enctype="multipart/form-data" action="{{route('perbaikan', $pelaporan->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="catatan">Catatan Perbaikan</label>
                            <textarea class="form-control my-editor" id="my-editor" name="catatan" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="foto">Upload Foto</label> <br>
                            <input type="file" onchange="readFile(this);" accept="image/gif, image/jpeg, image/png, image/jpg" name="foto" id="file"><br>
                            <img src="#" class="mt-2" id="output" alt="Upload Foto Kerusakan" width="350" height="300" hidden>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-secondary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
    @endif 
</div>
@endsection
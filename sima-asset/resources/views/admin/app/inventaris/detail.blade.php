@extends('admin.layouts.app')

@section('content')
<h2 class="font-weight-bold text-secondary"><strong>Detail Inventaris</strong></h2>
<div class="card mb-4 mt-4">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3 mt-2">
            <h3 class="font-weight-bold text-secondary"><strong>Informasi Inventaris</strong></h3>
            <a href="{{route('inventaris-export-pdf', $inventaris->id)}}" type="button" class="btn btn-outline-success mb-4">
                <i class="fa-solid fa-file-export"></i> Export PDF
            </a>
        </div>
        <hr>
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th scope="row">Aset</th>
                    <td>{{$aset->nama}} - {{$aset->kode_barang}}</td>
                </tr>
                <tr>
                    <th scope="row">Ruangan</th>
                    <td>{{$ruangan->nama}} - {{$ruangan->kode_ruangan}}</td>
                </tr>
                <tr>
                    <th scope="row">Kode Inventaris</th>
                    <td>{{$inventaris->kode_inventaris}}</td>
                </tr>
                <tr>
                    <th scope="row">Tahun</th>
                    <td>{{($aset->tahun)? $aset->tahun:'--'}}</td>
                </tr>
                <tr>
                    <th scope="row">Harga</th>
                    <td>Rp. {{number_format($aset->harga_satuan, 2)}} / {{$aset->satuan}}</td>
                </tr>
                <tr>
                    <th scope="row">Status</th>
                    <td>{{$aset->kondisi == 1?'Terpelihara':'Tidak Terpelihara'}}</td>
                </tr>
                <tr>
                    <th scope="row">Kondisi</th>
                    @if($inventaris->kondisi == 0)
                    <td><h5><span class="badge badge-success">Baik</span></h5></td>
                    @elseif($inventaris->kondisi == 1)
                    <td><h5><span class="badge badge-warning">Rusak Ringan</span></h5></td>
                    @elseif($inventaris->kondisi == 2)
                    <td><h5><span class="badge badge-danger">Rusak Berat</span></h5></td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3 mt-2">
            <h5 class="font-weight-bold text-secondary"><strong>Cetak Barcode & QR-Code</strong></h5>
        </div>
        <hr>
        <h5>Barcode</h5>
        <a href="{{route('inventaris-export-barcode', $inventaris->id)}}" type="button" class="btn btn-lg btn-outline-warning text-right mb-4">
            <i class="fa-solid fa-print"></i> Barcode
        </a>
        <h5>QR-CODE</h5>
        <a href="{{route('invetaris-generate-qr', $inventaris->id)}}" type="button" class="btn btn-lg btn-outline-primary text-right mb-4">
            <i class="fa-solid fa-eye"></i> QR-CODE
        </a>
    </div>
</div>

@endsection
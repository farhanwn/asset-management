@extends('admin.layouts.app')
@section('content')
<div class="card shadow mb-4 mt-5">
    <div class="card-body">
        <h3 class="font-weight-bold text-secondary mb-2 mt-2"><strong>Ubah Aset</strong></h3>
        <form class="p-3" method="POST" action="{{route('aset-update', $aset->id)}}">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="nama">Nama Aset</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{$aset->nama}}" required>
                </div>
                <div class="col-md-6">
                    <label for="tahun">Tahun</label>
                    <input type="text" class="form-control" id="tahun" name="tahun" value="{{$aset->tahun}}" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="satuan">Satuan</label>
                    <select class="form-control" id="satuan" name="satuan" required>
                        <option value="Buah" {{$aset->satuan == 'Buah' ? 'selecetd': ''}}>Buah</option>
                        <option value="Pcs" {{$aset->satuan == 'Pcs' ? 'seleced' : ''}}>Pcs</option>
                        <option value="Unit" {{$aset->satuan == 'Unit' ? 'selected' : ''}}>Unit</option>
                        <option value="Set" {{$aset->satuan == 'Set' ? 'selected' : ''}}>Set</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="harga_satuan">Harga Satuan</label>
                    <input type="number" class="form-control" id="harga_satuan" value="{{$aset->harga_satuan}}" name="harga_satuan" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="kondisi">Kondisi</label>
                    <select class="form-control" id="kondisi" name="kondisi" required>
                        <option value="1" {{$aset->kondisi == 1 ? 'selected':''}}>Terpelihara</option>
                        <option value="0" {{$aset->kondisi == 0 ? 'selected' : ''}}>Tidak Terpelihara</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-success mt-3">Submit</button>
        </form>

    </div>
</div>
@endsection
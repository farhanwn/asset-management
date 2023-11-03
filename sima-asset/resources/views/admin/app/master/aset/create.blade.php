@extends('admin.layouts.app')
@section('content')
<div class="card shadow mb-4 mt-5">
    <div class="card-body">
        <h3 class="font-weight-bold text-secondary mb-2 mt-2"><strong>Tambah Aset</strong></h3>
        <form class="p-3" method="POST" action="{{route('aset-store')}}">
            @csrf
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="nama">Nama Aset</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="col-md-6">
                    <label for="tahun">Tahun</label>
                    <input type="text" class="form-control" id="tahun" name="tahun">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="satuan">Satuan</label>
                    <select class="form-control" id="satuan" name="satuan" required>
                        <option value="Buah">Buah</option>
                        <option value="Pcs">Pcs</option>
                        <option value="Unit">Unit</option>
                        <option value="Set">Set</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="harga_satuan">Harga Satuan</label>
                    <input type="number" class="form-control" id="harga_satuan" name="harga_satuan" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="kondisi">Kondisi</label>
                    <select class="form-control" id="kondisi" name="kondisi" required>
                        <option value="0">Baik</option>
                        <option value="1">Rusak Ringan</option>
                        <option value="2">Rusak Berat</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-success mt-3">Submit</button>
        </form>

    </div>
</div>
@endsection
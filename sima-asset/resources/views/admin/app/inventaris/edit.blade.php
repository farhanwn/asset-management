@extends('admin.layouts.app')
@section('content')
<div class="card shadow mb-4 mt-5">
    <div class="card-body">
        <h3 class="font-weight-bold text-secondary mb-2 mt-2"><strong>Ubah Inventaris</strong></h3>
        <form class="p-3" method="POST" action="{{route('inventaris-update', $data->id)}}">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="aset_id">Aset</label>
                    <select class="form-control" id="aset_id" name="aset_id" required disabled>
                        @foreach($asets as $aset)
                        <option value="{{$aset->id}}" {{$aset->id == $data->aset_id ? 'selected' : ''}}>{{$aset->nama}}-({{$aset->kode_barang}})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="ruangan_id">Ruangan</label>
                    <select class="form-control" id="ruangan_id" name="ruangan_id" required>
                        @foreach($ruangans as $ruangan)
                        <option value="{{$ruangan->id}}" {{$ruangan->id == $data->ruangan_id ? 'selected' : ''}}>{{$ruangan->nama}}-({{$ruangan->kode_ruangan}})</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="kondisi">Kondisi</label>
                    <select class="form-control" id="kondisi" name="kondisi" required>
                        <option value="0" {{$data->kondisi == 0  ? 'checked':''}}>Baik</option>
                        <option value="1" {{$data->kondisi == 1 ? 'checked':''}}>Rusak Ringan</option>
                        <option value="2" {{$data->kondisi == 2  ? 'checked':''}}>Rusak Berat</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-secondary mt-3">Submit</button>
        </form>

    </div>
</div>
@endsection
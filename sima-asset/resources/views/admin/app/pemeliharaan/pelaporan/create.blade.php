@extends('admin.layouts.app')
@section('content')
<div class="card shadow mb-4 mt-5">
    <div class="card-body">
        <h3 class="font-weight-bold text-secondary mb-2 mt-2"><strong>Tambah Aset Rusak</strong></h3>
        <form class="p-3" method="POST" enctype="multipart/form-data" action="{{route('pelaporan-store')}}">
            @csrf
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="aset_id">Aset</label>
                    <select class="form-control" id="aset_id" name="aset_id" required>
                        @foreach($asets as $aset)
                        <option value="{{$aset->id}}">{{$aset->nama}} - {{$aset->kode_barang}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="ruangan_id">Ruangan</label>
                    <select class="form-control" id="ruangan_id" name="ruangan_id" required>
                        @foreach($ruangans as $ruangan)
                        <option value="{{$ruangan->id}}">{{$ruangan->nama}} - {{$ruangan->kode_ruangan}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="aset_id">Teknisi</label>
                    <select class="form-control" id="user_id" name="user_id" required>
                        @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="catatan">Catatan Kerusakan</label>
                    <textarea class="form-control my-editor" id="my-editor" name="catatan" rows="3" required></textarea>
                </div>
                <div class="col-md-6">
                    <label for="foto">Upload Foto</label> <br>
                    <input type="file" onchange="readFile(this);" accept="image/gif, image/jpeg, image/png, image/jpg" name="foto" id="file" required><br>
                    <img src="#" class="mt-2" id="output" alt="Upload Foto Kerusakan" width="300" height="300" hidden>
                </div>
            </div>
            <button type="submit" class="btn btn-secondary mt-3">Submit</button>
        </form>

    </div>
</div>
@endsection
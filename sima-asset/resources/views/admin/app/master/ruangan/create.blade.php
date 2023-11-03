@extends('admin.layouts.app')
@section('content')
<div class="card shadow mb-4 mt-5">
    <div class="card-body">
        <h3 class="font-weight-bold text-secondary mb-2 mt-2"><strong>Tambah Ruangan</strong></h3>
        <form class="p-3" method="POST" action="{{route('ruangan-store')}}">
            @csrf
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="nama">Nama Ruangan</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="col-md-6">
                    <label for="user_id">Penanggung Jawab</label>
                    <select class="form-control" id="user_id" name="user_id" required>
                        @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-secondary mt-3">Submit</button>
        </form>

    </div>
</div>
@endsection
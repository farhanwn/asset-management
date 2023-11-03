<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ruangan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Alert;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::all();

        return view('admin.app.master.ruangan.index', compact('ruangans'));
    }

    public function create()
    {
        $users = User::where('role_id', 3)->get();

        return view('admin.app.master.ruangan.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string',
        ]);

        if ($validator->fails()) {
            Alert::info('Warning', "Validation Error");
            return redirect()->back()->withInput();
        }

        try {
            Ruangan::create([
                'user_id' => $request->user_id,
                'nama' => $request->nama,
                'kode_ruangan' => $this->kodeRuangan()
            ]);

            Alert::success('Berhasil', 'Berhasil menambahkan ruangan');
            return redirect(route('ruangan-index'));
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect()->back();
        }
    }

    public function edit($ruanganId)
    {
        $ruangan = Ruangan::findOrFail($ruanganId);

        if (!$ruangan) {
            Alert::error('Error', 'Data ruangan tidak ditemukan!');
            return redirect()->back();
        }

        $users = User::where('role_id', 3)->get();

        return view('admin.app.master.ruangan.edit', compact('ruangan', 'users'));
    }

    public function update(Request $request, $ruanganId)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string',
        ]);

        if ($validator->fails()) {
            Alert::info('Warning', "Validation Error");
            return redirect()->back()->withInput();
        }

        $ruangan = Ruangan::findOrFail($ruanganId);

        if (!$ruangan) {
            Alert::error('Error', 'Data ruangan tidak ditemukan!');
            return redirect()->back();
        }

        try {
            $ruangan->update($request->all());
            Alert::success('Berhasil', 'Berhasil mengubah ruangan');
            return redirect(route('ruangan-index'));
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($ruanganId)
    {
        $ruangan = Ruangan::findOrFail($ruanganId);

        if (!$ruangan) {
            Alert::error('Error', 'Data ruangan tidak ditemukan!');
            return redirect()->back();
        }

        try {
            $ruangan->delete();
            Alert::success('Berhasil', 'Berhasil menghapus ruangan');
            return redirect(route('ruangan-index'));
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect()->back();
        }
    }

    private function kodeRuangan()
    {
        $ruangan = Ruangan::count();
        $kode = 'RG/' . Carbon::now()->format('Ymd') .'/'. $ruangan;

        return $kode;
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aset;
use App\Models\PemeliharaanAset;
use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Http\Request;
use Alert;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PelaporanController extends Controller
{
    public function index()
    {
        $datas = PemeliharaanAset::all();

        return view('admin.app.pemeliharaan.pelaporan.index', compact('datas'));
    }

    public function create()
    {
        $asets = Aset::all();
        $ruangans = Ruangan::all();
        $users = User::where([
            ['role_id', 2],
            ['status', 1]
        ])->get();

        return view('admin.app.pemeliharaan.pelaporan.create', compact('asets', 'ruangans', 'users'));
    }

    public function show($pelaporanId)
    {
        $pelaporan = PemeliharaanAset::where('id', $pelaporanId)->first();

        if (!$pelaporan) {
            Alert::error('Error', 'Data pelaporan tidak ditemukan!');
            return redirect()->back();
        }

        return view('admin.app.pemeliharaan.pelaporan.detail', compact('pelaporan'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'aset_id' => 'required|exists:asets,id',
            'ruangan_id' => 'required|exists:ruangans,id',
            'user_id' => 'required|exists:users,id',
            'foto' => 'required|image|mimes:jpeg,png,jpg,svg|max:500000',
            'catatan' => 'required'
        ]);

        if ($validator->fails()) {
            Alert::info('Warning',  'Validation Error');
            return redirect()->back()->withInput();
        }

        $file = $request->file('foto');
        $eks = $file->getClientOriginalExtension();
        $path = public_path('storage/uploads/');
        $name = "PL-".uniqid().".".$eks;

        try {
            $pelaporan = new PemeliharaanAset();
            $pelaporan->kode_pelaporan = $this->kodePelaporan();
            $pelaporan->aset_id = $request->aset_id;
            $pelaporan->ruangan_id = $request->ruangan_id;
            $pelaporan->user_id = $request->user_id;
            $pelaporan->status = 0;
            $pelaporan->created_by = Auth::user()->name;
            $pelaporan->foto = $name;
            $pelaporan->catatan = $request->catatan;
            if ($pelaporan->save()) {
                $file->move($path,$name);
                $user = User::where('id', $request->user_id)->first();
                $user->status = 0;
                $user->save();
            }

            Alert::success('Berhasil', 'Berhasil menambahkan pelaporan aset rusak');
            return redirect(route('pelaporan-index'));
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($pelaporanId)
    {
        $pelaporan = PemeliharaanAset::where('id', $pelaporanId)->first();

        if (!$pelaporan) {
            Alert::error('Error', 'Data pelaporan tidak ditemukan!');
            return redirect()->back();
        }

        $user = User::where('id', $pelaporan->user_id)->first();

        try {
            $pelaporan->delete();
            $user->status = 1;
            $user->save();
            Alert::success('Berhasil', 'Berhasil menghapus pelaporan aset rusak');
            return redirect(route('pelaporan-index'));
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect()->back();
        }
    }

    private function kodePelaporan()
    {
        $pelaporan = PemeliharaanAset::count();
        $kode = 'PL/'.Carbon::now()->format('Ymd').'/'.$pelaporan;

        return $kode;
    }
}

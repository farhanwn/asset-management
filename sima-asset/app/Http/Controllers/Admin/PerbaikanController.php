<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PemeliharaanAset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;
use App\Models\Aset;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class PerbaikanController extends Controller
{
    public function index()
    {
        $datas = PemeliharaanAset::where('user_id', Auth::id())->get();

        return view('admin.app.pemeliharaan.perbaikan.index', compact('datas'));
    }

    public function show($pelaporanId)
    {
        $pelaporan = PemeliharaanAset::where('id', $pelaporanId)->first();

        if (!$pelaporan) {
            Alert::error('Error', 'Data pelaporan tidak ditemukan!');
            return redirect()->back();
        }

        return view('admin.app.pemeliharaan.perbaikan.detail', compact('pelaporan'));
    }

    public function approved($perbaikanId)
    {
        $data = PemeliharaanAset::where('id', $perbaikanId)->first();

        if (!$data) {
            Alert::error('Error', 'Data pelaporan tidak ditemukan!');
            return redirect()->back();
        }

        try {
            $data->status = 1;
            $data->save();
            Alert::success('Berhasil', 'Berhasil approved pelaporan aset rusak');
            return redirect(route('pelaporan-index'));
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect()->back();
        }
    }

    public function perbaikan($perbaikanId, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'required|image|mimes:jpeg,png,jpg,svg|max:500000',
            'catatan' => 'required|string'
        ]);

        if ($validator->fails()) {
            Alert::info('Warning',  'Validation Error');
            return redirect()->back()->withInput();
        }
        $data = PemeliharaanAset::where('id', $perbaikanId)->first();

        if (!$data) {
            Alert::error('Error', 'Data pelaporan tidak ditemukan!');
            return redirect()->back();
        }

        $file = $request->file('foto');
        $eks = $file->getClientOriginalExtension();
        $path = public_path('storage/uploads/');
        $name = "PR-" . uniqid() . "." . $eks;

        try {
            $data->status = 2;
            $data->catatan = $request->catatan;
            $data->foto = $name;
            $data->save();
            $file->move($path, $name);
            Alert::success('Berhasil', 'Berhasil done pelaporan aset rusak');
            return redirect(route('perbaikan-index'));
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect()->back();
        }
    }

    public function done($perbaikanId, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kondisi' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::info('Warning',  'Validation Error');
            return redirect()->back()->withInput();
        }

        $data = PemeliharaanAset::where('id', $perbaikanId)->first();

        if (!$data) {
            Alert::error('Error', 'Data pelaporan tidak ditemukan!');
            return redirect()->back();
        }

        $user = User::where('id', $data->user_id)->first();
        $aset = Aset::where('id', $data->aset_id)->first();

        try {
            $data->status = 3;
            $user->status = 1;
            $aset->kondisi = $request->kondisi;
            $data->save();
            $user->save();
            $aset->save();
            Alert::success('Berhasil', 'Berhasil done pelaporan aset rusak');
            return redirect(route('pelaporan-index'));
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect()->back();
        }
    }
}

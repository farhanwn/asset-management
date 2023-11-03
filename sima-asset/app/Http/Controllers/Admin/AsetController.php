<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Alert;
use Carbon\Carbon;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AsetController extends Controller
{
    public function index()
    {
        $datas = Aset::all();

        return view('admin.app.master.aset.index', compact('datas'));
    }

    public function show($asetId)
    {
        $aset = Aset::findOrFail($asetId);

        if (!$aset) {
            Alert::error('Error', 'Data master aset tidak ditemukan!');
            return redirect()->back();
        }

        return view('admin.app.master.aset.detail', compact('aset'));
    }

    public function create()
    {
        return view('admin.app.master.aset.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'satuan' => 'required|string',
            'harga_satuan' => 'required|',
            'kondisi' => 'required'
        ]);

        if ($validator->fails()) {
            Alert::info('Warning', "Validation Error");
            return redirect()->back()->withInput();
        }

        try {
            Aset::create([
                'nama' => $request->nama,
                'kode_barang' => $this->generateKodeBarang(),
                'harga_satuan' => $request->harga_satuan,
                'tahun' => $request->tahun,
                'satuan' => $request->satuan,
                'kondisi' => $request->kondisi
            ]);

            Alert::success('Berhasil', 'Berhasil menambahkan aset');
            return redirect(route('aset-index'));
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect()->back();
        }
    }

    public function edit($asetId)
    {
        $aset = Aset::findOrFail($asetId);

        if (!$aset) {
            Alert::error('Error', 'Data aset tidak ditemukan!');
            return redirect()->back();
        }

        return view('admin.app.master.aset.edit', compact('aset'));
    }

    public function update(Request $request, $asetId)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'satuan' => 'required|string',
            'harga_satuan' => 'required|',
            'kondisi' => 'required'
        ]);

        if ($validator->fails()) {
            Alert::info('Warning', "Validation Error");
            return redirect()->back()->withInput();
        }

        $aset = Aset::where('id', $asetId)->first();
        if (!$aset) {
            Alert::error('Error', 'Data aset tidak ditemukan!');
            return redirect()->back();
        }


        try {
            if ($request->harga_satuan != $aset->harga_satuan) {
                $aset->update([
                    'nama' => $request->nama,
                    'tahun' => $request->tahun,
                    'kondisi' => $request->kondisi
                ]);
            } else {
                $aset->update([
                    'nama' => $request->nama,
                    'harga_satuan' => $request->harga_satuan,
                    'tahun' => $request->tahun,
                    'kondisi' => $request->kondisi,
                    'harga_total' => $this->hitungHargaTotal($aset->jumlah, $request->harga_satuan)
                ]);
            }
            Alert::success('Berhasil', 'Berhasil mengubah aset');
            return redirect(route('aset-index'));
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($asetId)
    {
        $aset = Aset::where('id', $asetId)->first();
        if (!$aset) {
            Alert::error('Error', 'Data aset tidak ditemukan!');
            return redirect()->back();
        }

        try {
            $aset->delete();
            Alert::success('Berhasil', 'Berhasil menghapus aset');
            return redirect(route('aset-index'));
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect()->back();
        }
    }

    private function hitungHargaTotal($jumlah, $harga_satuan)
    {
        $harga_total = $harga_satuan * $jumlah;

        return $harga_total;
    }

    private function generateKodeBarang()
    {
        $aset = Aset::count();
        $kode =  'AST/' . Carbon::now()->format('Ymd') . '/' . $aset;

        return $kode;
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aset;
use App\Models\Inventaris;
use App\Models\Ruangan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Alert;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class InventarisController extends Controller
{
    public function index()
    {
        $datas = Inventaris::all();

        return view('admin.app.inventaris.index', compact('datas'));
    }

    public function create()
    {
        $asets = Aset::all();
        $ruangans = Ruangan::all();

        return view('admin.app.inventaris.create', compact('asets', 'ruangans'));
    }

    public function show($inventarisId)
    {
        $inventaris = Inventaris::where('id', $inventarisId)->first();

        if (!$inventaris) {
            Alert::error('Error', 'Data inventaris tidak ditemukan!');
            return redirect()->back();
        }

        $aset = Aset::where('id', $inventaris->aset_id)->first();
        $ruangan = Ruangan::where('id', $inventaris->ruangan_id)->first();

        return view('admin.app.inventaris.detail', compact('aset', 'ruangan', 'inventaris'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'aset_id' => 'required|exists:asets,id',
            'ruangan_id' => 'required|exists:ruangans,id',
            'kondisi' => 'required'
        ]);

        if ($validator->fails()) {
            Alert::info('Warning', "Validation Error");
            return redirect()->back()->withInput();
        }

        try {
            Inventaris::create([
                'aset_id' => $request->aset_id,
                'ruangan_id' => $request->ruangan_id,
                'kode_inventaris' => $this->kodeInventaris(),
                'kondisi' => $request->kondisi,
            ]);

            $aset = Aset::where('id', $request->aset_id)->first();
            $jumlah = $this->countJumlah($aset->jumlah);
            $aset->jumlah = $jumlah;
            $aset->harga_total = $jumlah * $aset->harga_satuan;
            $aset->save();

            Alert::success('Berhasil', 'Berhasil menambahkan inventaris');
            return redirect(route('inventaris-index'));
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect()->back();
        }
    }

    public function edit($inventarisId)
    {
        $data = Inventaris::findOrFail($inventarisId);

        if (!$data) {
            Alert::error('Error', 'Data inventaris tidak ditemukan!');
            return redirect()->back();
        }

        $asets = Aset::all();
        $ruangans = Ruangan::all();

        return view('admin.app.inventaris.edit', compact('data', 'asets', 'ruangans'));
    }

    public function update(Request $request, $inventarisId)
    {
        $validator = Validator::make($request->all(), [
            'ruangan_id' => 'required|exists:ruangans,id',
            'kondisi' => 'required'
        ]);

        if ($validator->fails()) {
            Alert::info('Warning', "Validation Error");
            return redirect()->back()->withInput();
        }

        $data = Inventaris::findOrFail($inventarisId);

        if (!$data) {
            Alert::error('Error', 'Data inventaris tidak ditemukan!');
            return redirect()->back();
        }


        try {
            $data->update($request->all());
            Alert::success('Berhasil', 'Berhasil mengubah inventaris');
            return redirect(route('inventaris-index'));
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($inventarisId)
    {

        $data = Inventaris::findOrFail($inventarisId);

        if (!$data) {
            Alert::error('Error', 'Data inventaris tidak ditemukan!');
            return redirect()->back();
        }

        try {
            $aset = Aset::where('id', $data->aset_id)->first();
            $jumlah = $this->minJumlah($aset->jumlah);
            $aset->jumlah = $jumlah;
            $aset->harga_total = $jumlah * $aset->harga_satuan;
            $aset->save();
            $data->delete();
            Alert::success('Berhasil', 'Berhasil menghapus inventaris');
            return redirect(route('inventaris-index'));
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect()->back();
        }
    }

    public function exportPDF($inventarisId)
    {
        $inventaris = Inventaris::where('id', $inventarisId)->first();

        if (!$inventaris) {
            Alert::error('Error', 'Data inventaris tidak ditemukan!');
            return redirect()->back();
        }

        $aset = Aset::where('id', $inventaris->aset_id)->first();
        $ruangan = Ruangan::where('id', $inventaris->ruangan_id)->first();

        $pdf = PDF::loadview('admin.app.inventaris.data-pdf', [
            'inventaris' => $inventaris,
            'aset' => $aset,
            'ruangan' => $ruangan
        ]);

        return $pdf->download('laporan-detail-inventaris.pdf');
    }

    public function generateQrCode($inventarisId)
    {
        $inventaris = Inventaris::where('id', $inventarisId)->first();

        if (!$inventaris) {
            Alert::error('Error', 'Data inventaris tidak ditemukan!');
            return redirect()->back();
        }

        $aset = Aset::where('id', $inventaris->aset_id)->first();
        $ruangan = Ruangan::where('id', $inventaris->ruangan_id)->first();

        $content = url('/') . '/inventaris/detail/' . $inventaris->id;
        $qr = QrCode::generate($content);
        return view('admin.app.inventaris.generate-qr', compact('inventaris', 'aset', 'ruangan', 'qr'));
    }

    public function exportBarcode($inventarisId)
    {
        $inventaris = Inventaris::where('id', $inventarisId)->first();

        if (!$inventaris) {
            Alert::error('Error', 'Data inventaris tidak ditemukan!');
            return redirect()->back();
        }

        $aset = Aset::where('id', $inventaris->aset_id)->first();
        $ruangan = Ruangan::where('id', $inventaris->ruangan_id)->first();
        $content = url('/') . '/inventaris/detail/' . $inventaris->id;
        $qr = base64_encode(QrCode::size(150)->generate($content));
        $pdf = PDF::loadview('admin.app.inventaris.print-barcode', [
            'qrCode' => $qr,
            'inventaris' => $inventaris,
            'aset' => $aset,
            'ruangan' => $ruangan
        ]);

        return $pdf->download('inventaris-barcode-'.$inventaris->kode_inventaris.'.pdf');
    }

    private function countJumlah($value)
    {
        $count = $value + 1;
        return $count;
    }

    private function minJumlah($value)
    {
        $data = $value - 1;
        return $data;
    }

    private function kodeInventaris()
    {
        $inventaris = Inventaris::count();
        $kode = 'INVT/' . Carbon::now()->format('Ymd') . '/' . $inventaris;

        return $kode;
    }
}

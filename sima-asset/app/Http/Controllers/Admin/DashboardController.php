<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aset;
use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $asets = Aset::count();
        $ruangans = Ruangan::count();
        $kepalaRuangan = User::where('role_id', 3)->count();
        $teknisi = User::where('role_id', 2)->count();
        return view('admin.app.index', compact('asets', 'ruangans', 'kepalaRuangan', 'teknisi'));
    }
}

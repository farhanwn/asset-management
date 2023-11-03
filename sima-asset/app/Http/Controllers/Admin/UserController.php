<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Alert;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.app.master.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.app.master.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_id' => 'required|exists:roles,id',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|min:4|unique:users,username',
            'name' => 'required|string|min:5',
            'nip' => 'required|string',
            'jabatan' => 'required',
            'password' => 'required|min:6',
        ]);


        if ($validator->fails()) {
            Alert::info('Warning', "Validation Error");
            return redirect()->back()->withInput();
        }

        try {
            User::create([
                'role_id' => $request->role_id,
                'username' => $request->username,
                'name' => $request->name,
                'nip' => $request->nip,
                'jabatan' => $request->jabatan,
                'password' => bcrypt($request->password),
                'email' => $request->email,
                'email_verified_at' => Carbon::now(),
                'status' => 1,
            ]);
            Alert::success('Berhasil', 'Berhasil menambahkan user');
            return redirect(route('user-index'));
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect()->back();
        }
    }

    public function edit($userId)
    {
        $user = User::findOrFail($userId);

        if (!$user) {
            Alert::error('Error', 'Data user tidak ditemukan!');
            return redirect()->back();
        }

        $roles = Role::all();
        return view('admin.app.master.user.edit', compact('roles', 'user'));
    }

    public function update(Request $request, $userId)
    {
        $validator = Validator::make($request->all(), [
            'role_id' => 'required|exists:roles,id',
            'email' => 'required|email',
            'username' => 'required|string|min:4',
            'name' => 'required|string|min:5',
            'nip' => 'required|string',
            'jabatan' => 'required',
        ]);


        if ($validator->fails()) {
            Alert::info('Warning', "Validation Error");
            return redirect()->back()->withInput();
        }

        $user = User::findOrFail($userId);

        if (!$user) {
            Alert::error('Error', 'Data user tidak ditemukan!');
            return redirect()->back();
        }

        try {
            $user->role_id = $request->role_id;
            $user->name = $request->name;
            $user->username = $request->username;
            $user->nip = $request->nip;
            $user->jabatan = $request->jabatan;
            $user->email = $request->email;
            if ($request->password != null) {
                $user->password = $request->password;
            }
            $user->save();
            Alert::success('Berhasil', 'Berhasil mengubah user');
            return redirect(route('user-index'));
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($userId)
    {
        $user = User::findOrFail($userId);

        if (!$user) {
            Alert::error('Error', 'Data user tidak ditemukan!');
            return redirect()->back();
        }

        try {
            $user->delete();
            Alert::success('Berhasil', 'Berhasil menghapus user');
            return redirect(route('user-index'));
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect()->back();
        }
    }
}

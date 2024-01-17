<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = User::all();
        return view('karyawan.index', compact('karyawan'));
    }

    public function createKaryawan()
    {
        return view('karyawan.create');
    }

    public function storeKaryawan(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'email' => 'required',
                'jabatan' => 'required',
                'jenis_kelamin' => 'required',
            ]);

            // create username
            $username = $this->username($request->nama);

            // password 
            $password = '12345678';

            // role
            if ($request->jabatan == 'Kepala Tukang') {
                $role = 2;
            }
            if ($request->jabatan == 'Admin Produksi') {
                $role = 3;
            }
            if ($request->jabatan == 'Kepala Produksi') {
                $role = 4;
            }
            if ($request->jabatan == 'Staff Produksi') {
                $role = 1;
            }

            // create user
            User::create([
                'nama' => $request->nama,
                'username' => $username,
                'email' => $request->email,
                'jabatan' => $request->jabatan,
                'jenis_kelamin' => $request->jenis_kelamin,
                'password' => bcrypt($password),
                'role' => $role,
            ]);

            return redirect()->route('karyawan.index')->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('karyawan.index')->with('error', 'Data gagal ditambahkan');
        }
    }

    // create function by name to username
    private function username($nama)
    {
        $username = explode(' ', $nama);
        $username = implode('', $username);
        return strtolower($username);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatan  = Jabatan::latest()->get();
        return view('admin.jabatan.index', compact('jabatan'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'gaji' => 'required',
            ]);
            $message = "";
            if ($request->id_jabatan) {
                Jabatan::find($request->id_jabatan)->update([
                    'name' => $request->name,
                    'sallary' => $request->gaji,
                ]);
                $message = "Selamat! Anda Berhasil mengupdate jabatan";
            } else {
                Jabatan::create([
                    'name' => $request->name,
                    'sallary' => $request->gaji,
                ]);
                $message = "Selamat! Anda Berhasil menambahkan jabatan";
            }

            return redirect()->back()->with('success', $message);
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e->withMessages(['name' => 'Nama Harus Diisi!', 'gaji' => 'Gaji Harus diisi!']);
        }
    }

    public function destroy(Request $request)
    {
        Jabatan::find($request->id)->delete();
        return redirect()->back()->with('success', 'Selamat! Anda Berhasil menghapus jabatan');
    }
}

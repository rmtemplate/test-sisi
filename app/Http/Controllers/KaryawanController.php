<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Cuti;
use App\Models\Gaji;
use App\Models\Jabatan;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::latest()->get();
        $jabatan = Jabatan::latest()->get();
        return view('admin.karyawan.index', compact('karyawan', 'jabatan'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'id_jabatan' => 'required',
            ]);
            $message = "";
            if ($request->id_karyawan) {
                Karyawan::find($request->id_karyawan)->update([
                    'name' => $request->name,
                    'id_jabatan' => $request->id_jabatan,
                ]);
                $message = "Selamat! Anda Berhasil mengupdate karyawan";
            } else {
                Karyawan::create([
                    'name' => $request->name,
                    'id_jabatan' => $request->id_jabatan,
                ]);
                $message = "Selamat! Anda Berhasil menambahkan karyawan";
            }

            return redirect()->back()->with('success', $message);
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e->withMessages(['name' => 'Nama Harus Diisi!', 'id_jabatan' => 'Jabatan Harus diisi!']);
        }
    }

    public function destroy(Request $request)
    {
        Karyawan::find($request->id)->delete();
        return redirect()->back()->with('success', 'Selamat! Anda Berhasil menghapus karyawan');
    }

    public function detail($id)
    {
        $karyawan = Karyawan::find($id);
        return view('admin.karyawan.detail', compact('karyawan'));
    }

    public function storeAbsensi(Request $request)
    {
        try {
            $request->validate([
                'date' => 'required',
                'keterangan' => 'required',
            ]);
            $message = "";
            if ($request->id_absensi) {
                Absensi::find($request->id_absensi)->update([
                    'id_karyawan' => $request->id_karyawan,
                    'tanggal' => $request->date,
                    'keterangan' => $request->keterangan,
                ]);
                $message = "Selamat! Anda Berhasil mengupdate absensi";
            } else {
                Absensi::create([
                    'id_karyawan' => $request->id_karyawan,
                    'tanggal' => $request->date,
                    'keterangan' => $request->keterangan,
                ]);
                $message = "Selamat! Anda Berhasil menambahkan absensi";
            }

            return redirect()->back()->with('success', $message);
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e->withMessages(['date' => 'Date Harus Diisi!', 'keterangan' => 'Keterangan Harus diisi!']);
        }
    }

    public function destroyAbsensi(Request $request)
    {
        Absensi::find($request->id)->delete();
        return redirect()->back()->with('success', 'Selamat! Anda Berhasil menghapus absen');
    }

    // Cuti

    public function storeCuti(Request $request)
    {
        try {
            $request->validate([
                'start' => 'required',
                'end' => 'required',
                'keterangan' => 'required',
            ]);
            $message = "";
            if ($request->id_cuti) {
                Cuti::find($request->id_cuti)->update([
                    'id_karyawan' => $request->id_karyawan,
                    'start' => $request->start,
                    'end' => $request->end,
                    'keterangan' => $request->keterangan,
                    'status' => 0,
                ]);
                $message = "Selamat! Anda Berhasil mengupdate cuti";
            } else {
                Cuti::create([
                    'id_karyawan' => $request->id_karyawan,
                    'start' => $request->start,
                    'end' => $request->end,
                    'keterangan' => $request->keterangan,
                    'status' => 0,
                ]);
                $message = "Selamat! Anda Berhasil menambahkan cuti";
            }

            return redirect()->back()->with('success', $message);
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e->withMessages(['start' => 'Start Harus Diisi!', 'end' => 'End Harus Diisi!', 'keterangan' => 'Keterangan Harus diisi!']);
        }
    }

    public function destroyCuti(Request $request)
    {
        Cuti::find($request->id)->delete();
        return redirect()->back()->with('success', 'Selamat! Anda Berhasil menghapus cuti');
    }

    // Gaji

    public function storeGaji(Request $request)
    {
        try {
            $request->validate([
                'tanggal_gaji' => 'required',
                'potongan_bpjs' => 'required',
                'potongan_lainnya' => 'required',
            ]);
            $message = "";
            if ($request->id_gaji) {
                Gaji::find($request->id_gaji)->update([
                    'id_karyawan' => $request->id_karyawan,
                    'tanggal_gaji' => $request->tanggal_gaji,
                    'potongan_bpjs' => $request->potongan_bpjs,
                    'potongan_lainnya' => $request->potongan_lainnya,
                    'gaji_kotor' => Karyawan::find($request->id_karyawan)->jabatan->sallary,
                    'gaji_bersih' => (Karyawan::find($request->id_karyawan)->jabatan->sallary) - ($request->potongan_bpjs + $request->potongan_lainnya),
                ]);
                $message = "Selamat! Anda Berhasil mengupdate gaji";
            } else {
                Gaji::create([
                    'id_karyawan' => $request->id_karyawan,
                    'tanggal_gaji' => $request->tanggal_gaji,
                    'potongan_bpjs' => $request->potongan_bpjs,
                    'potongan_lainnya' => $request->potongan_lainnya,
                    'gaji_kotor' => Karyawan::find($request->id_karyawan)->jabatan->sallary,
                    'gaji_bersih' => (Karyawan::find($request->id_karyawan)->jabatan->sallary) - ($request->potongan_bpjs + $request->potongan_lainnya),
                ]);
                $message = "Selamat! Anda Berhasil menambahkan gaji";
            }

            return redirect()->back()->with('success', $message);
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e->withMessages(['tanggal_gajian' => 'Tanggal Gaji Harus Diisi!', 'potongan_bpjs' => 'Potongan BPJS Harus Diisi!', 'potongan_lainnya' => 'Potongan Lainnya Harus diisi!']);
        }
    }

    public function destroyGaji(Request $request)
    {
        Gaji::find($request->id)->delete();
        return redirect()->back()->with('success', 'Selamat! Anda Berhasil menghapus gaji');
    }
}

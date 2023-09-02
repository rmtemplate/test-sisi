<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'id_jabatan'];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_karyawan', 'id')->orderBy('tanggal', 'asc');
    }

    public function cuti()
    {
        return $this->hasMany(Cuti::class, 'id_karyawan', 'id');
    }

    public function gaji()
    {
        return $this->hasMany(Gaji::class, 'id_karyawan', 'id');
    }
}

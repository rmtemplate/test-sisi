<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    protected $fillable = ['id_karyawan', 'tanggal_gaji', 'potongan_bpjs', 'potongan_lainnya', 'gaji_kotor', 'gaji_bersih'];
}

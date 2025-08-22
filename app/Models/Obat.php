<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $fillable = [
        'kode_obat',
        'nama_obat',
        'pabrik',
        'golongan',
        'komposisi',
        'generik',
        'kemasan',
        'satuan',
        'isi_obat',
        'dosis',
        'sediaan',
        'barcode',
        'harga_hna',
        'harga_ppn',
        'hja'
    ];
}

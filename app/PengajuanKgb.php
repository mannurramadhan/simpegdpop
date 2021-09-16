<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengajuanKgb extends Model
{
    protected $primaryKey = 'id';

    protected $table = "pengajuan_kgbs";
    
    protected $fillable = [
        'id', 'pegawais_nip', 'gaji_lama', 'gaji_baru', 'pejabat_lama', 'pejabat_baru', 'no_sk_lama',
        'no_sk_baru', 'tanggal_sk_lama', 'tanggal_sk_baru', 'tmt_lama', 'tmt_baru', 'mkg_lama', 'mkg_baru',
        'tanggal_kgb_baru'
    ];
}

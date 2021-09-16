<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengajuanKpp extends Model
{
    protected $primaryKey = 'id';

    protected $table = "pengajuan_kpps";
    
    protected $fillable = [
        'id', 'pegawais_nip', 'golongan_baru', 'pejabat', 'no_sk',
        'tanggal_sk', 'tmt'
    ];
}

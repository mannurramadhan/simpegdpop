<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengambilanCuti extends Model
{
    protected $primaryKey = 'id';

    protected $table = "pengambilan_cutis";
    
    protected $fillable = [
        'id', 'nip', 'nama', 'tahun_cuti', 'tahun_sisa_cuti',
        'tanggal_mulai_cuti', 'tanggal_akhir_cuti'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KearsipanPegawai extends Model
{
    protected $primaryKey = 'id';

    protected $table = "kearsipan_pegawais";

    protected $fillable = [
        'id', 'pegawais_nip', 'tahun_pensiun_mutasi'
    ];

    public function pegawais(){
        return $this->belongsTo('App\Pegawai');
    }
}

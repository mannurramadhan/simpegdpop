<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $primaryKey = 'nip';

    protected $table = "pegawais";

    protected $fillable = [
        'nip', 'nik', 'nama', 'tempat_lahir', 'tanggal_lahir', 'usia', 'jenis_kelamin', 'pendidikan_terakhir', 'jabatan',
        'status_kepegawaian', 'golongan', 'mkg', 'gajis_id', 'gaji_pegawai', 'sisa_tahun_n', 'sisa_tahun_n1', 
        'sisa_tahun_n2', 'tahun_masuk_kerja', 'tahun_terakhir_kgb', 'tahun_terakhir_pangkat',
        'tahun_pensiun', 'update_kgb', 'update_pangkat', 'update_pensiun'
    ];

    public function gajis(){
        return $this->belongsTo('App\Gaji');
    }

    public function golongans(){
        return $this->belongsTo('App\Golongan');
    }

    public function kearsipan_pegawais(){
        return $this->hasOne('App\KearsipanPegawai');
    }

    public function kpps(){
        return $this->hasOne('App\Kpp');
    }

    public function kgbs(){
        return $this->hasOne('App\Kgb');
    }
}

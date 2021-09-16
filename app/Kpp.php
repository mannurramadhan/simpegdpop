<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kpp extends Model
{
    protected $primaryKey = 'id';

    protected $table = "kpps";

    protected $fillable = [
        'id', 'pegawais_nip', 'kenaikan_golongan', 'durasi_kpp', 'created_at', 'updated_at'
    ];

    public function pegawais(){
        return $this->belongsTo('App\Pegawai');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kgb extends Model
{
    protected $primaryKey = 'id';

    protected $table = "kgbs";

    protected $fillable = [
        'id', 'pegawais_nip', 'kenaikan_gaji', 'durasi_kgb', 'created_at', 'updated_at'
    ];

    public function pegawais(){
        return $this->belongsTo('App\Pegawai');
    }
}

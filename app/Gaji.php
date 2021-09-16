<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gaji extends Model
{
    protected $primaryKey = "id";

    protected $table = "gajis";

    protected $fillable = ['id', 'golongan', 'mkg', 'gaji_pokok'];

    public function pegawais(){
        return $this->hasMany('App\Pegawai');
    }
}

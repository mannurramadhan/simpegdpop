<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    protected $primaryKey = "id";

    protected $table = "golongans";

    protected $fillable = ['id', 'golongan'];

    public function pegawais(){
        return $this->hasMany('App\Pegawai');
    }
}

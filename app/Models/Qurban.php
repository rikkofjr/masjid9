<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Traits\Uuids;


class Qurban extends Model
{
    use HasFactory, Uuids, SoftDeletes;

    protected $table = 'tb_qurban_penerimaan';
    protected $dates = ['deleted_at'];

    protected $filablle = [
        'jenis_hewan', 
        'atas_nama',
        'nama_lain',
        'permintaan',
        'nomor_handphone',
        'disaksikan',
        'keterangan',
        'hijri',
        'nomor_hewan'
    ];
    
    
    public function data_amil(){
        return $this->belongsTo('App\Models\User', 'amil');  
    }
}

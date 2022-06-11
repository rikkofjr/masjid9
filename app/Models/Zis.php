<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;
use App\Traits\Uuids;


class Zis extends Model
{
    use HasFactory, SoftDeletes, Uuids, HasRoles;

    use SoftDeletes; 

    protected $filablle = [
        'zis_name', 
        'amil', 
        'atas_nama', 
        'nama_lain', 
        'jumlah_jiwa', 
        'jumlah_uang_zakat',
        'jumlah_uang_infaq',
        'jumlah_uang_shadaqoh',
        'beras_zakat',
        'beras_infaq',
        'beras_shadaqoh',
        'hijri'
    ];
    protected $table ='tb_zis';
    protected $dates = ['deleted_at'];

    public function jenis_zakat(){
        return $this->belongsTo('App\Models\ZisType', 'id_zis_type');
        
    }
    public function data_amil(){
        return $this->belongsTo('App\Models\User', 'amil');  
    }
    
}

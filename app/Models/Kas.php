<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Traits\Uuids;
use EloquentFilter\Filterable;


class Kas extends Model
{
    use HasFactory, SoftDeletes, Uuids, Filterable;
    protected $table = 'tb_kas_transaksi';
    protected $fillable = [
        'jenis',
        'cat_transaksi_id',
        'nama_transaksi',
        'catatan',
        'debit',
        'kredit'
    ];
    protected $dates = ['deteled_at'];

    

    public function data_penginput(){
        return $this->belongsTo('App\Models\User', 'penginput');  
    }
    public function kategori_transaksi(){
        return $this->belongsTo('App\Models\KasKategori', 'cat_transaksi_id');
    }
}

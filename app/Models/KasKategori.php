<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Traits\Uuids;
use EloquentFilter\Filterable;

class KasKategori extends Model
{
    use HasFactory, Uuids, Filterable;
    protected $table = "tb_kas_transaksi_kategori";
    protected $fillable = [
        'cat_transaksi'
    ];
    public function kas(){
        return $this->hasMany('App\Models\Kas', 'id');
    }
}

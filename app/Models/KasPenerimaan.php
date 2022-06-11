<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;
use App\Traits\Uuids;

class KasPenerimaan extends Model
{
    use HasFactory, SoftDeletes, Uuids, HasRoles;
    protected $table = 'tb_kas_penerimaan';
    protected $fillable = [
        'keterangan',
        'catatan',
        'penerimaan'
    ];
    protected $dates = ['deteled_at'];

    public function data_penginput(){
        return $this->belongsTo('App\Models\User', 'penginput');  
    }
}

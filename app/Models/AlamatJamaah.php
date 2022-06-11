<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;
use App\Traits\Uuids;

class AlamatJamaah extends Model
{
    use HasFactory, SoftDeletes, Uuids, HasRoles;

    //protected $primaryKey = 'uuid';
    protected $table = 'tb_alamat_jamaah';
    protected $fillable = [
        'nama_pemilik', 
        'kategori_alamat', 
        'kategori_jamaah', 
        'alamat', 
        'rt', 
        'rw', 
    ];
    protected $dates = ['deleted_at'];

    
    public function anggotaKeluarga()
    {
        return $this->hasMany(DataJamaah::class, 'id_alamat_jamaah');
    }
}

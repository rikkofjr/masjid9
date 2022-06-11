<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;
use App\Traits\Uuids;


class KasPengeluaran extends Model
{
    use HasFactory, SoftDeletes, Uuids, HasRoles;
    protected $table = 'tb_kas_pengeluaran';
    protected $fillable = [
        'keterangan',
        'catatan',
        'pengeluaran'
    ];
    protected $dates = ['deteled_at'];

    public function data_penginput(){
        return $this->belongsTo('App\Models\User', 'penginput');  
    }
}

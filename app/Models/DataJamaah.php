<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;
use App\Traits\Uuids;


class DataJamaah extends Model
{
    use HasFactory, SoftDeletes, Uuids, HasRoles;
    protected $table = 'tb_data_jamaah';
    protected $fillable = [
        'nama', 
        'jenis_kelamin', 
        'tanggal_lahir'
    ];
    protected $dates = ['deleted_at'];

    
}

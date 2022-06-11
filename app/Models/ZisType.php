<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

use App\Models\Zis;


class ZisType extends Model
{
    use HasFactory, Uuids;
    protected $table ='tb_zis_type';
    protected $fillable = ['zis_type'];

    public function zis(){
        return $this->hasMany(Zis::class, 'id_zis_type');
    }
    
}

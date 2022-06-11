<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasjidProfile extends Model
{
    use HasFactory;
    protected $table ="tb_masjid_info";

    public function data_amil(){
        return $this->belongsTo('App\Models\User', 'user_update')->withDefault(['name' => 'Bagong']);  
    }
}

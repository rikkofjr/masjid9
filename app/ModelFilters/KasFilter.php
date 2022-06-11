<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class KasFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */ 
    public $relations = [];

    public function jenis($jenis){
        if($jenis){
            return $this->where('jenis', '=' , $jenis);
        }
    }
    public function kategori($cat_transaksi_id){
        if($cat_transaksi_id){
            return $this->where('cat_transaksi_id', '=', $cat_transaksi_id);
        }
    }
    public function startDate($startDate){
        if($startDate){
            return $this->whereDate('created_at', '>=', $startDate);
        }
    }
    public function endDate($endDate){
        if($endDate){
            return $this->whereDate('created_at', '<=', $endDate);
        }
    }
    // public function kategori($cat_transaksi_id){
    //     if($cat_transaksi_id){
    //         return $this->where('id', '=', $cat_transaksi_id);
    //     }
    // }
    public function tahun($tahun){
        if($tahun){
            return $this->whereYear('created_at', '=' , $tahun);
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailProduksi extends Model
{
    use HasFactory;

    protected $table = 'detail_produksi';
    protected $guarded = ['id'];

    public function produksi()
    {
        return $this->belongsTo(Produksi::class, 'produksi_id', 'id');
    }

    public function estimasi()
    {
        return $this->belongsTo(Estimasi::class, 'estimasi_id', 'id');
    }

    public function penjadwalan()
    {
        return $this->belongsTo(Penjadwalan::class, 'penjadwalan_id', 'uuid');
    }
}

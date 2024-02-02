<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjadwalan extends Model
{
    use HasFactory;
    protected $table = 'penjadwalan';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'uuid';
    protected $guarded = [];

    public function estimasi()
    {
        return $this->belongsTo(Estimasi::class, 'estimasi_id', 'id');
    }

    public function detailProduksi()
    {
        return $this->hasMany(DetailProduksi::class, 'penjadwalan_id', 'id');
    }
}
